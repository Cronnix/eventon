function blockDelete(block_id) {
    if (confirm("Are you sure?")) { //skickas ett confirm meddelande, om man klickar ok skickas man vidare till block_event_db med block_id och function satt till deleteBlock
        window.location="functions/block_event/block_event_db.php?block_id=" + block_id + "&function=deleteBlock";
    }
}
function eventDelete(event_id) {
    if (confirm("Are you sure?")) { //skickas ett confirm meddelande, om man klickar ok skickas man vidare till block_event_db med event_id och function satt till deleteEvent
        window.location="functions/block_event/block_event_db.php?event_id=" + event_id + "&function=deleteEvent";
    }
}