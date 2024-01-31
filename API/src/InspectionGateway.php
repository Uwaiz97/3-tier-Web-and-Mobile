<?php

class InspectionGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM inspection";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $row["insp_extinguishers"] = (bool) $row["insp_extinguishers"];
            $row["insp_dbBrdSign"] = (bool) $row["insp_dbBrdSign"];
            $row["insp_exitDoors"] = (bool) $row["insp_exitDoors"];
            $row["insp_smkDetect"] = (bool) $row["insp_smkDetect"];
            $row["insp_fireBlankets"] = (bool) $row["insp_fireBlankets"];
            $row["insp_emgyNum"] = (bool) $row["insp_emgyNum"];
            $row["insp_fireAlarm"] = (bool) $row["insp_fireAlarm"];
            $row["insp_emgyExitRoute"] = (bool) $row["insp_emgyExitRoute"];
            $row["insp_fireEqptSign"] = (bool) $row["insp_fireEqptSign"];
            $row["insp_firstAid"] = (bool) $row["insp_firstAid"];
            $row["insp_fence"] = (bool) $row["insp_fence"];
            $row["insp_gates"] = (bool) $row["insp_gates"];
            $row["insp_cctv"] = (bool) $row["insp_cctv"];
            $row["insp_burglarProof"] = (bool) $row["insp_burglarProof"];
            $row["insp_armedResp"] = (bool) $row["insp_armedResp"];
            $row["insp_panicBTN"] = (bool) $row["insp_panicBTN"];
            $row["insp_roomLocks"] = (bool) $row["insp_roomLocks"];
            $row["insp_security"] = (bool) $row["insp_security"];
            $row["insp_lighting"] = (bool) $row["insp_lighting"];
            $row["insp_emgySigns"] = (bool) $row["insp_emgySigns"];
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO inspection (insp_status, prop_id) 
                VALUES (:insp_status, :prop_id)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":insp_status", $data["insp_status"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_id", $data["prop_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM inspection
                WHERE insp_id = :insp_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":insp_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data !== false) {
            $data["insp_extinguishers"] = (bool) $data["insp_extinguishers"];
            $data["insp_dbBrdSign"] = (bool) $data["insp_dbBrdSign"];
            $data["insp_exitDoors"] = (bool) $data["insp_exitDoors"];
            $data["insp_smkDetect"] = (bool) $data["insp_smkDetect"];
            $data["insp_fireBlankets"] = (bool) $data["insp_fireBlankets"];
            $data["insp_emgyNum"] = (bool) $data["insp_emgyNum"];
            $data["insp_fireAlarm"] = (bool) $data["insp_fireAlarm"];
            $data["insp_emgyExitRoute"] = (bool) $data["insp_emgyExitRoute"];
            $data["insp_fireEqptSign"] = (bool) $data["insp_fireEqptSign"];
            $data["insp_firstAid"] = (bool) $data["insp_firstAid"];
            $data["insp_fence"] = (bool) $data["insp_fence"];
            $data["insp_gates"] = (bool) $data["insp_gates"];
            $data["insp_cctv"] = (bool) $data["insp_cctv"];
            $data["insp_burglarProof"] = (bool) $data["insp_burglarProof"];
            $data["insp_armedResp"] = (bool) $data["insp_armedResp"];
            $data["insp_panicBTN"] = (bool) $data["insp_panicBTN"];
            $data["insp_roomLocks"] = (bool) $data["insp_roomLocks"];
            $data["insp_security"] = (bool) $data["insp_security"];
            $data["insp_lighting"] = (bool) $data["insp_lighting"];
            $data["insp_emgySigns"] = (bool) $data["insp_emgySigns"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE inspection
                SET insp_status = :insp_status, insp_ocaDate = :insp_ocaDate, insp_ohsDate = :insp_ohsDate, insp_secDate = :insp_secDate, insp_ocaBeds = :insp_ocaBeds, insp_nMatrass = :insp_nMatrass, insp_matrassTotalRate = :insp_matrassTotalRate, insp_nMatrassBelow = :insp_nMatrassBelow, insp_nCurtains = :insp_nCurtains, insp_curtainsTotalRate = :insp_curtainsTotalRate, insp_nCurtainsBelow = :insp_nCurtainsBelow, insp_nPaperBins = :insp_nPaperBins, insp_paperBinsTotalRate = :insp_paperBinsTotalRate, insp_nPaperBinsBelow = :insp_nPaperBinsBelow, insp_nBookshelves = :insp_nBookshelves, insp_bookshTotalRate = :insp_bookshTotalRate, insp_nBookshelvesBelow = :insp_nBookshelvesBelow, insp_nDesks = :insp_nDesks, insp_desksTotalRate = :insp_desksTotalRate, insp_nDesksBelow = :insp_nDesksBelow, insp_nChairs = :insp_nChairs, insp_chairsTotalRate = :insp_chairsTotalRate, insp_nChairsBelow = :insp_nChairsBelow, insp_nWardrobes = :insp_nWardrobes, insp_wardrobesTotalRate = :insp_wardrobesTotalRate, insp_nWardrobesBelow = :insp_nWardrobesBelow, insp_nHeaters = :insp_nHeaters, insp_heatersTotalRate = :insp_heatersTotalRate, insp_nHeatersBelow = :insp_nHeatersBelow, insp_nStudyLamp = :insp_nStudyLamp, insp_studyLampTotalRate = :insp_studyLampTotalRate, insp_nStudyLampBelow = :insp_nStudyLampBelow, insp_numShareRooms = :insp_numShareRooms, insp_numSingleRoom = :insp_numSingleRoom, insp_nFridges = :insp_nFridges, insp_fridgesTotalRate = :insp_fridgesTotalRate, insp_nFridgesBelow = :insp_nFridgesBelow, insp_nMicrowaves = :insp_nMicrowaves, insp_microwavesTotalRate = :insp_microwavesTotalRate, insp_nMicrowavesBelow = :insp_nMicrowavesBelow, insp_nShowers = :insp_nShowers, insp_showersTotalRate = :insp_showersTotalRate, insp_nShowersBelow = :insp_nShowersBelow, insp_nSinks = :insp_nSinks, insp_sinksTotalRate = :insp_sinksTotalRate, insp_nSinksBelow = :insp_nSinksBelow, insp_nLckCupboards = :insp_nLckCupboards, insp_nLckCupboardsShelves = :insp_nLckCupboardsShelves, insp_lckCupboardstotalRate = :insp_lckCupboardstotalRate, insp_nLckCupboardsBelow = :insp_nLckCupboardsBelow, insp_nCntrTops = :insp_nCntrTops, insp_cntrTopsTotalRate = :insp_cntrTopsTotalRate, insp_nCntrTopsBelow = :insp_nCntrTopsBelow, insp_nStoves = :insp_nStoves, insp_nStovePlates = :insp_nStovePlates, insp_stovesTotalRate = :insp_stovesTotalRate, insp_nStovesBelow = :insp_nStovesBelow, insp_nLaundryFac = :insp_nLaundryFac, insp_laundryFacTotalRate = :insp_laundryFacTotalRate, insp_nLaundryFacBelow = :insp_nLaundryFacBelow, insp_nToilets = :insp_nToilets, insp_toiletstotalRate = :insp_toiletstotalRate, insp_nToiletsBelow = :insp_nToiletsBelow, insp_nBasins = :insp_nBasins, insp_basinsTotalRate = :insp_basinsTotalRate, insp_nBasinsBelow = :insp_nBasinsBelow, insp_nSheBins = :insp_nSheBins, insp_sheBinsTotalRate = :insp_sheBinsTotalRate, insp_nSheBinsBelow = :insp_nSheBinsBelow, insp_extinguishers = :insp_extinguishers, insp_dbBrdSign = :insp_dbBrdSign, insp_exitDoors = :insp_exitDoors, insp_smkDetect = :insp_smkDetect, insp_fireBlankets = :insp_fireBlankets, insp_emgyNum = :insp_emgyNum, insp_fireAlarm = :insp_fireAlarm, insp_emgyExitRoute = :insp_emgyExitRoute, insp_emgySigns = :insp_emgySigns, insp_fireEqptSign = :insp_fireEqptSign, insp_firstAid = :insp_firstAid, insp_fence = :insp_fence, insp_gates = :insp_gates, insp_panicBTN = :insp_panicBTN, insp_cctv = :insp_cctv, insp_burglarProof = :insp_burglarProof, insp_armedResp = :insp_armedResp, insp_roomLocks = :insp_roomLocks, insp_security = :insp_security, insp_lighting = :insp_lighting, insp_commentSection = :insp_commentSection, oca_Id = :oca_Id, sec_Id = :sec_Id, ohs_Id = :ohs_Id
                WHERE insp_id = :insp_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":insp_status", $new["insp_status"] ?? $current["insp_status"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_ocaDate", $new["insp_ocaDate"] ?? $current["insp_ocaDate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_ohsDate", $new["insp_ohsDate"] ?? $current["insp_ohsDate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_secDate", $new["insp_secDate"] ?? $current["insp_secDate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_ocaBeds", $new["insp_ocaBeds"] ?? $current["insp_ocaBeds"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nMatrass", $new["insp_nMatrass"] ?? $current["insp_nMatrass"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_matrassTotalRate", $new["insp_matrassTotalRate"] ?? $current["insp_matrassTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nMatrassBelow", $new["insp_nMatrassBelow"] ?? $current["insp_nMatrassBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nCurtains", $new["insp_nCurtains"] ?? $current["insp_nCurtains"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_curtainsTotalRate", $new["insp_curtainsTotalRate"] ?? $current["insp_curtainsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nCurtainsBelow", $new["insp_nCurtainsBelow"] ?? $current["insp_nCurtainsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nPaperBins", $new["insp_nPaperBins"] ?? $current["insp_nPaperBins"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_paperBinsTotalRate", $new["insp_paperBinsTotalRate"] ?? $current["insp_paperBinsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nPaperBinsBelow", $new["insp_nPaperBinsBelow"] ?? $current["insp_nPaperBinsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nBookshelves", $new["insp_nBookshelves"] ?? $current["insp_nBookshelves"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_bookshTotalRate", $new["insp_bookshTotalRate"] ?? $current["insp_bookshTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nBookshelvesBelow", $new["insp_nBookshelvesBelow"] ?? $current["insp_nBookshelvesBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nDesks", $new["insp_nDesks"] ?? $current["insp_nDesks"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_desksTotalRate", $new["insp_desksTotalRate"] ?? $current["insp_desksTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nDesksBelow", $new["insp_nDesksBelow"] ?? $current["insp_nDesksBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nChairs", $new["insp_nChairs"] ?? $current["insp_nChairs"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_chairsTotalRate", $new["insp_chairsTotalRate"] ?? $current["insp_chairsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nChairsBelow", $new["insp_nChairsBelow"] ?? $current["insp_nChairsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nWardrobes", $new["insp_nWardrobes"] ?? $current["insp_nWardrobes"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_wardrobesTotalRate", $new["insp_wardrobesTotalRate"] ?? $current["insp_wardrobesTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nWardrobesBelow", $new["insp_nWardrobesBelow"] ?? $current["insp_nWardrobesBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nHeaters", $new["insp_nHeaters"] ?? $current["insp_nHeaters"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_heatersTotalRate", $new["insp_heatersTotalRate"] ?? $current["insp_heatersTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nHeatersBelow", $new["insp_nHeatersBelow"] ?? $current["insp_nHeatersBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nStudyLamp", $new["insp_nStudyLamp"] ?? $current["insp_nStudyLamp"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_studyLampTotalRate", $new["insp_studyLampTotalRate"] ?? $current["insp_studyLampTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nStudyLampBelow", $new["insp_nStudyLampBelow"] ?? $current["insp_nStudyLampBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_numShareRooms", $new["insp_numShareRooms"] ?? $current["insp_numShareRooms"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_numSingleRoom", $new["insp_numSingleRoom"] ?? $current["insp_numSingleRoom"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nFridges", $new["insp_nFridges"] ?? $current["insp_nFridges"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_fridgesTotalRate", $new["insp_fridgesTotalRate"] ?? $current["insp_fridgesTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nFridgesBelow", $new["insp_nFridgesBelow"] ?? $current["insp_nFridgesBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nMicrowaves", $new["insp_nMicrowaves"] ?? $current["insp_nMicrowaves"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_microwavesTotalRate", $new["insp_microwavesTotalRate"] ?? $current["insp_microwavesTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nMicrowavesBelow", $new["insp_nMicrowavesBelow"] ?? $current["insp_nMicrowavesBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nShowers", $new["insp_nShowers"] ?? $current["insp_nShowers"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_showersTotalRate", $new["insp_showersTotalRate"] ?? $current["insp_showersTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nShowersBelow", $new["insp_nShowersBelow"] ?? $current["insp_nShowersBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nSinks", $new["insp_nSinks"] ?? $current["insp_nSinks"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_sinksTotalRate", $new["insp_sinksTotalRate"] ?? $current["insp_sinksTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nSinksBelow", $new["insp_nSinksBelow"] ?? $current["insp_nSinksBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nLckCupboards", $new["insp_nLckCupboards"] ?? $current["insp_nLckCupboards"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nLckCupboardsShelves", $new["insp_nLckCupboardsShelves"] ?? $current["insp_nLckCupboardsShelves"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_lckCupboardstotalRate", $new["insp_lckCupboardstotalRate"] ?? $current["insp_lckCupboardstotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nLckCupboardsBelow", $new["insp_nLckCupboardsBelow"] ?? $current["insp_nLckCupboardsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nCntrTops", $new["insp_nCntrTops"] ?? $current["insp_nCntrTops"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_cntrTopsTotalRate", $new["insp_cntrTopsTotalRate"] ?? $current["insp_cntrTopsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nCntrTopsBelow", $new["insp_nCntrTopsBelow"] ?? $current["insp_nCntrTopsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nStoves", $new["insp_nStoves"] ?? $current["insp_nStoves"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nStovePlates", $new["insp_nStovePlates"] ?? $current["insp_nStovePlates"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_stovesTotalRate", $new["insp_stovesTotalRate"] ?? $current["insp_stovesTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nStovesBelow", $new["insp_nStovesBelow"] ?? $current["insp_nStovesBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nLaundryFac", $new["insp_nLaundryFac"] ?? $current["insp_nLaundryFac"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_laundryFacTotalRate", $new["insp_laundryFacTotalRate"] ?? $current["insp_laundryFacTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nLaundryFacBelow", $new["insp_nLaundryFacBelow"] ?? $current["insp_nLaundryFacBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nToilets", $new["insp_nToilets"] ?? $current["insp_nToilets"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_toiletstotalRate", $new["insp_toiletstotalRate"] ?? $current["insp_toiletstotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nToiletsBelow", $new["insp_nToiletsBelow"] ?? $current["insp_nToiletsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nBasins", $new["insp_nBasins"] ?? $current["insp_nBasins"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_basinsTotalRate", $new["insp_basinsTotalRate"] ?? $current["insp_basinsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nBasinsBelow", $new["insp_nBasinsBelow"] ?? $current["insp_nBasinsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_nSheBins", $new["insp_nSheBins"] ?? $current["insp_nSheBins"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_sheBinsTotalRate", $new["insp_sheBinsTotalRate"] ?? $current["insp_sheBinsTotalRate"], PDO::PARAM_STR);
        $stmt->bindValue(":insp_nSheBinsBelow", $new["insp_nSheBinsBelow"] ?? $current["insp_nSheBinsBelow"], PDO::PARAM_INT);
        $stmt->bindValue(":insp_extinguishers", $new["insp_extinguishers"] ?? $current["insp_extinguishers"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_dbBrdSign", $new["insp_dbBrdSign"] ?? $current["insp_dbBrdSign"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_exitDoors", $new["insp_exitDoors"] ?? $current["insp_exitDoors"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_smkDetect", $new["insp_smkDetect"] ?? $current["insp_smkDetect"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_fireBlankets", $new["insp_fireBlankets"] ?? $current["insp_fireBlankets"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_emgyNum", $new["insp_emgyNum"] ?? $current["insp_emgyNum"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_fireAlarm", $new["insp_fireAlarm"] ?? $current["insp_fireAlarm"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_emgyExitRoute", $new["insp_emgyExitRoute"] ?? $current["insp_emgyExitRoute"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_emgySigns", $new["insp_emgySigns"] ?? $current["insp_emgySigns"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_fireEqptSign", $new["insp_fireEqptSign"] ?? $current["insp_fireEqptSign"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_firstAid", $new["insp_firstAid"] ?? $current["insp_firstAid"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_fence", $new["insp_fence"] ?? $current["insp_fence"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_gates", $new["insp_gates"] ?? $current["insp_gates"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_panicBTN", $new["insp_panicBTN"] ?? $current["insp_panicBTN"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_cctv", $new["insp_cctv"] ?? $current["insp_cctv"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_burglarProof", $new["insp_burglarProof"] ?? $current["insp_burglarProof"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_armedResp", $new["insp_armedResp"] ?? $current["insp_armedResp"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_roomLocks", $new["insp_roomLocks"] ?? $current["insp_roomLocks"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_security", $new["insp_security"] ?? $current["insp_security"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_lighting", $new["insp_lighting"] ?? $current["insp_lighting"], PDO::PARAM_BOOL);
        $stmt->bindValue(":insp_commentSection", $new["insp_commentSection"] ?? $current["insp_commentSection"], PDO::PARAM_STR);
        $stmt->bindValue(":oca_Id", $new["oca_Id"] ?? $current["oca_Id"], PDO::PARAM_INT);
        $stmt->bindValue(":sec_Id", $new["sec_Id"] ?? $current["sec_Id"], PDO::PARAM_INT);
        $stmt->bindValue(":ohs_Id", $new["ohs_Id"] ?? $current["ohs_Id"], PDO::PARAM_INT);

        $stmt->bindValue(":insp_id", $current["insp_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM inspection
                WHERE insp_id = :insp_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":insp_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function getStaff($id)
    {
        $sql = "SELECT * 
                FROM staff 
                WHERE staff_id = :staff_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":staff_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    private function checkPropertyExist($prop_id): bool
    {
        $sql = "SELECT * 
                FROM inspection 
                WHERE prop_id = :prop_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_id", $prop_id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getByPropID(string $id): array|false
    {
        $sql = "SELECT *
                FROM inspection
                WHERE prop_id = :prop_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}