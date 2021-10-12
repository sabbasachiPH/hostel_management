<?php
function get_hall_list($hall_id = NULL)
{
    include('connection.php');
    if ($hall_id == NULL) {
        $sql = "select * from hall_information order by hall_name";
        $result = $conn->query($sql);

        $hall_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($hall_array, $row);
        }
        return $hall_array;
    } else {
        $sql = "select * from hall_information WHERE $hall_id='" . $hall_id . "'. order by hall_name";
        $result = $conn->query($sql);

        $hall_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($hall_array, $row);
        }
        return $hall_array;
    }
}

function get_floor_list($hall_id = NULL)
{
    include('connection.php');
    if ($hall_id == NULL) {
        $sql = "SELECT * FROM floor_information order by floor_name";
        $result = $conn->query($sql);

        $floor_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($floor_array, $row);
        }
        return $floor_array;
    } else {
        $sql = "select * from floor_information WHERE hall_id='" . $hall_id . "'order by floor_name";
        $result = $conn->query($sql);
        $floor_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($floor_array, $row);
        }
        return $floor_array;
    }
}


function get_room_list($hall_id = NULL)
{
    include('connection.php');
    if ($hall_id == NULL) {
        $sql = "SELECT * FROM room_information order by hall_id";
        $result = $conn->query($sql);

        $room_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($room_array, $row);
        }
        return $room_array;
    } else {
        $sql = "select * from room_information WHERE hall_id='" . $hall_id . "'order by room_id";
        $result = $conn->query($sql);

        // echo ("<pre>");
        // var_dump(mysqli_fetch_assoc($result));
        $room_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($room_array, $row);
        }
        return $room_array;
    }
}

function get_floor_room_list($floor_id = NULL)
{
    include('connection.php');
    if ($floor_id == NULL) {
        $sql = "SELECT * FROM room_information order by floor_name";
        $result = $conn->query($sql);

        $floor_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($floor_array, $row);
        }
        return $floor_array;
    } else {
        $sql = "select * from room_information WHERE floor_id='" . $floor_id . "'order by room_no";
        $result = $conn->query($sql);
        $floor_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($floor_array, $row);
        }
        return $floor_array;
    }
}

if (isset($_REQUEST['type'])) {
    if ($_REQUEST['type'] == "floor") {
        echo json_encode(get_floor_list($_REQUEST['hall_id']));
    } else if ($_REQUEST['type'] == "room") {
        echo json_encode(get_room_list($_REQUEST['hall_id']));
    } else if ($_REQUEST['type'] == "froom") {
        echo json_encode(get_floor_room_list($_REQUEST['floor_id']));
    }
} else {
    echo json_encode(get_hall_list());
}
