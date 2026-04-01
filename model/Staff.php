<?php
// model/OfficialModel.php

require_once __DIR__ . '/Connection.php';

class AdminModel extends Dbh
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = Dbh::getInstance();
    }
    public function getAllBrgy()
    {
        $result = $this->mysqli->query(" SELECT  b.BRGY_ID, b.BARANGAY, 
        COUNT(p.BRGY_ID) AS total_persons,
        COUNT(o.BRGY_ID) AS total_officials
        FROM tbl_brgy b
        LEFT JOIN tbl_personal_info p ON b.BRGY_ID = p.BRGY_ID
        LEFT JOIN tbl_officials o ON b.BRGY_ID = o.BRGY_ID
        GROUP BY b.BRGY_ID
    ");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function getOfficials()
    {
        $result = $this->mysqli->query("SELECT  * FROM tbl_brgy b 
        INNER JOIN tbl_officials o ON b.BRGY_ID = o.BRGY_ID
        INNER JOIN tbl_position p ON o.POSITION = p.POSITION_ID
        GROUP BY b.BRGY_ID");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getOfficialsBrgy($brgy)
    {
        $stmt = $this->mysqli->prepare("SELECT b.BRGY_ID, b.BARANGAY, o.*, p.POSITION_NAME FROM tbl_brgy b INNER JOIN tbl_officials o ON b.BRGY_ID = o.BRGY_ID INNER JOIN tbl_position p ON o.POSITION = p.POSITION_ID WHERE b.BRGY_ID = ?");

        $stmt->bind_param("i", $brgy);
        $stmt->execute();

        $result = $stmt->get_result();

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $_SESSION['BARANGAY'] = $row['BARANGAY'];
            $_SESSION['BRGY_ID'] = $row['BRGY_ID'];
            $rows[] = $row;
        }

        return $rows;
    }
    public function getStatus()
    {
        $result = $this->mysqli->query("SELECT STATUS_ID, STATUS_NAME FROM tbl_status ORDER BY STATUS_NAME ASC");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function getPosition()
    {
        $result = $this->mysqli->query("SELECT POSITION_ID, POSITION_NAME, DATE_ADDED  FROM tbl_position ORDER BY DATE_ADDED ASC");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function emailExists($email)
    {
        $count = 0;

        $stmt = $this->mysqli->prepare("SELECT COUNT(*) FROM tbl_officials WHERE EMAIL = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function brgyExists($id)
    {
        $stmt = $this->mysqli->prepare("SELECT BRGY_ID FROM tbl_brgy WHERE BRGY_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }


    public function addOfficials($fname, $lname, $mname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title, $photoName, $emp_id)
    {

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $stmt = $this->mysqli->prepare("INSERT INTO tbl_officials (PHOTO, EMP_ID, F_NAME, L_NAME, M_NAME, DOB, POB, CIVIL_STATUS, EMAIL, CONTACT, POSITION, BRGY_ID, TITLE, DATE_STARTED, DATE_ENDED, STATUS) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,NULL , 'active')");

        $stmt->bind_param(
            "sssssssisssiis",
            $photoName,
            $emp_id,
            $fname,
            $lname,
            $mname,
            $dob,
            $pob,
            $cs,
            $email,
            $contact,
            $position,
            $brgy,
            $title,
            $date
        );

        $result = $stmt->execute();

        return $result;
    }

    public function updateInfoOfficial($id, $fname, $mname, $lname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title, $emp_id, $photoToSave)
    {

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $stmt = $this->mysqli->prepare(" UPDATE tbl_officials SET  PHOTO = ?, EMP_ID = ?, F_NAME = ?, L_NAME = ?, M_NAME = ?, DOB = ?, POB = ?, CIVIL_STATUS = ?, EMAIL = ?, CONTACT = ?, POSITION = ?, BRGY_ID = ?, TITLE = ? WHERE OFFICIAL_ID = ?");

        $stmt->bind_param("ssssssssssiisi", $photoToSave, $emp_id, $fname,  $lname, $mname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title, $id);

        $result = $stmt->execute();

        return $result;
    }

    public function requests()
    {
        $query = "SELECT 
                r.*,
                c.*, 
                u.PI_ID,u.USER_ID, u.FNAME, u.MNAME, u.LNAME, u.CONTACT, u.EMAIL
              FROM tbl_requests r
              INNER JOIN tbl_personal_info u
              ON r.USER_ID = u.USER_ID
              INNER JOIN tbl_certificates c 
              ON r.CERT_ID = c.CERT_ID
              ORDER BY r.REQ_DATE DESC";

        $stmt = $this->mysqli->query($query);

        if (!$stmt) {
            error_log("MySQL Error: " . $this->mysqli->error);
            return [];
        }

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
    public function officials()
    {
        $query = "SELECT * FROM tbl_officials o INNER JOIN tbl_brgy b ON o.BRGY_ID = b.BRGY_ID";

        $stmt = $this->mysqli->query($query);

        if (!$stmt) {
            error_log("MySQL Error: " . $this->mysqli->error);
            return [];
        }

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
    public function users()
    {
        $query = "SELECT * FROM tbl_users u INNER JOIN tbl_personal_info p ON u.u_id = p.USER_ID";

        $stmt = $this->mysqli->query($query);

        if (!$stmt) {
            error_log("MySQL Error: " . $this->mysqli->error);
            return [];
        }

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getRequests($rid, $uid)
    {
        $stmt = $this->mysqli->prepare("
        SELECT 
            r.*, 
            p.*, 
            c.*, 
            b.*
        FROM tbl_requests r 
        INNER JOIN tbl_personal_info p ON r.USER_ID = p.USER_ID 
        INNER JOIN tbl_certificates c ON r.CERT_ID = c.CERT_ID
        INNER JOIN tbl_brgy b ON p.BRGY_ID = b.BRGY_ID
        WHERE r.REQ_ID = ? AND p.USER_ID = ?
    ");

        $stmt->bind_param("ii", $rid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public function generate($uid, $pid, $rid, $cid)
    {
        $stmt = $this->mysqli->prepare("SELECT * 
        FROM tbl_requests r 
        INNER JOIN tbl_personal_info p 
        ON r.USER_ID = p.USER_ID 
        INNER JOIN tbl_certificates c
        ON r.CERT_ID = c.CERT_ID
        INNER JOIN tbl_brgy b
        ON p.BRGY_ID = b.BRGY_ID
        WHERE r.REQ_ID = ? AND p.USER_ID = ?");
        $stmt->bind_param("ii", $rid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }
    public function insertPost($title, $description, $files = [])
    {
        $files_json = json_encode($files); // store file paths as JSON
        $stmt = $this->mysqli->prepare("INSERT INTO tbl_posts (TITLE, DESCRIPTION, DATE_CREATED, FILES, STATUS) VALUES (?, ?,NOW , ?, 1)");
        $stmt->bind_param("sss", $title, $description, $files_json);
        return $stmt->execute();
    }


    public function getBrgy()
    {
        $result = $this->mysqli->query("SELECT COUNT(*) AS total_brgy FROM tbl_brgy");

        if ($row = $result->fetch_assoc()) {
            return $row['total_brgy']; // return integer directly
        }

        return 0;
    }

    public function getAllUsers()
    {
        $result = $this->mysqli->query("SELECT COUNT(u_id) AS total_users FROM tbl_users");

        if ($row = $result->fetch_assoc()) {
            return $row['total_users']; // return integer directly
        }

        return 0;
    }

    public function getAllReq()
    {
        $result = $this->mysqli->query("SELECT COUNT(REQ_ID) AS total_req FROM tbl_requests");

        if ($row = $result->fetch_assoc()) {
            return $row['total_req']; // return integer directly
        }

        return 0;
    }

    public function seeOfficialData($id)
    {
        $stmt = $this->mysqli->prepare("SELECT o.*, s.STATUS_ID, s.STATUS_NAME, b.BRGY_ID, b.BARANGAY
        FROM tbl_officials o
        LEFT JOIN tbl_status s ON o.CIVIL_STATUS = s.STATUS_ID
        LEFT JOIN tbl_brgy b ON o.BRGY_ID = b.BRGY_ID
        WHERE o.OFFICIAL_ID = ?
    ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
