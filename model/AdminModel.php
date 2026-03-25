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
        $result = $this->mysqli->query("SELECT * FROM tbl_brgy ORDER BY BARANGAY ASC");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getBrgy()
    {
        $result = $this->mysqli->query("SELECT BRGY_ID, BARANGAY FROM tbl_brgy ORDER BY BARANGAY ASC");

        $rows = [];
        while ($row = $result->fetch_assoc()) {
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


    public function addOfficials($fname, $lname, $mname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO tbl_officials (F_NAME, L_NAME, M_NAME, DOB, POB, CIVIL_STATUS, EMAIL, CONTACT, POSITION, BRGY_ID, TITLE, STATUS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'NEW')");

        $stmt->bind_param(
            "sssssssssis",
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
            $title
        );

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
        $stmt = $this->mysqli->prepare("SELECT * 
        FROM tbl_requests r 
        INNER JOIN tbl_personal_info p 
        ON r.USER_ID = p.USER_ID 
        INNER JOIN tbl_certificates c
        ON r.CERT_ID = c.CERT_ID
        WHERE r.REQ_ID = ? AND p.USER_ID = ?");
        $stmt->bind_param("ii", $rid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }
    public function generate($uid, $pid, $rid, $cid)
    {
        $stmt = $this->mysqli->prepare("SELECT * 
        FROM tbl_requests r 
        INNER JOIN tbl_personal_info p 
        ON r.USER_ID = p.USER_ID 
        INNER JOIN tbl_certificates c
        ON r.CERT_ID = c.CERT_ID
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
}
