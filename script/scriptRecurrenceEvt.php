<?php

function recurrence()
{

    $dernierCheck = file_get_contents('saveDay.txt');
    if (empty($dernierCheck)) {
        file_put_contents('saveDay.txt', date("d"));
        roll(mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
    } else {
        $mkTimeHier = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $hier = date("d", $mkTimeHier);
        if ((int) $hier == (int) $dernierCheck) {
            roll($mkTimeHier);
            file_put_contents('saveDay.txt', date("d"));
        }
    }
}
function roll($mkTimeHier)
{
    $bdd = bddConnect();
    //selectionner les evenements recursifs passés hier :
    $dateHier = date("Y", $mkTimeHier) . "-" . date("m", $mkTimeHier) . "-" . date("d", $mkTimeHier);
    $reqEvtRecHier = $bdd->prepare("SELECT*from evenement where recurrence=1 and date=:dateHier");
    $reqEvtRecHier->bindValue(':dateHier', $dateHier, PDO::PARAM_STR);
    $reqEvtRecHier->execute();
    $repEvtRecHier = $reqEvtRecHier->fetchAll(PDO::FETCH_CLASS);
    $repEvtRecHier = objectToArray($repEvtRecHier);
    foreach ($repEvtRecHier as $evtHier) {




        switch ((int) $evtHier['id_Temporalite']) {
            case 1:
                $newTimeStamp = strtotime('+1 day', $mkTimeHier);
                break;
            case 2:
                $newTimeStamp = strtotime('+7 day', $mkTimeHier);
                break;
            case 3:
                $newTimeStamp = strtotime('+1 month', $mkTimeHier);
                break;
            case 4:
                $newTimeStamp = strtotime('+1 year', $mkTimeHier);
                break;
            default:
                $newTimeStamp = $mkTimeHier;
                break;
        }
        $newDate = (date("Y-m-d", $newTimeStamp));
        $reqAddNewEvt = $bdd->prepare("call add_event(:date,:nom,:description,:image,:prix,1,:temp)");
        $reqAddNewEvt->bindValue(':date', $newDate, PDO::PARAM_STR);
        $reqAddNewEvt->bindValue(':nom', $evtHier['nom'], PDO::PARAM_STR);
        $reqAddNewEvt->bindValue(':description', $evtHier['description'], PDO::PARAM_STR);
        $reqAddNewEvt->bindValue(':image', $evtHier['url_image'], PDO::PARAM_STR);
        $reqAddNewEvt->bindValue(':prix', (int) $evtHier['prix'], PDO::PARAM_STR);
        $reqAddNewEvt->bindValue(':temp', (int) $evtHier['id_Temporalite'], PDO::PARAM_STR);

        $reqAddNewEvt->execute();
    }
}
