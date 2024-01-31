using System;
using System.Collections.Generic;
using System.Text;

namespace App2.Inspector
{
    public class Inspection
    {
        public string message { get; set; }
        public int insp_id { get; set; }
        public int? oca_Id { get; set; }
        public int? sec_Id { set; get; }
        public int? ohs_Id { set; get; }
        public int prop_Id { get; set; }
        public string insp_status { get; set; }
        public DateTime? insp_ocaDate { get; set; } //date tinme
        public DateTime? insp_ohsDate { get; set; }
        public DateTime? insp_secDate { get; set; }
        public int? insp_ocaBeds { get; set; }
        public int? insp_nMatrass { get; set; }
        public int? insp_matrassTotalRate { set; get; }
        public int? insp_nMatrassBelow { get; set; }
        public int? insp_nCurtains { get; set; }
        public int? insp_curtainsTotalRate { get; set; }
        public int? insp_nCurtainsBelow { get; set; }
        public int? insp_nPaperBins { get; set; }
        public int? insp_paperBinsTotalRate { get; set; }
        public int? insp_nPaperBinsBelow { get; set; }
        public int? insp_nBookshelves { get; set; }
        public int? insp_bookshTotalRate { get; set; }
        public int? insp_nBookshelvesBelow { get; set; }
        public int? insp_nDesks { get; set; }
        public int? insp_desksTotalRate { get; set; }
        public int? insp_nDesksBelow { get; set; }
        public int? insp_nChairs { get; set; }
        public int? insp_chairsTotalRate { get; set; }
        public int? insp_nChairsBelow { get; set; }
        public int? insp_nWardrobes { get; set; }
        public int? insp_wardrobesTotalRate { get; set; }
        public int? insp_nWardrobesBelow { get; set; }
        public int? insp_nHeaters { get; set; }
        public int? insp_heatersTotalRate { get; set; }
        public int ?insp_nHeatersBelow { get; set; }
        public int? insp_nStudyLamp { get; set; }
        public int? insp_studyLampTotalRate { get; set; }
        public int? insp_nStudyLampBelow { get; set; }
        public int? insp_numShareRooms { get; set; }
        public int? insp_numSingleRoom { get; set; }
        public int? insp_nFridges { get; set; }
        public int? insp_fridgesTotalRate { get; set; }
        public int? insp_nFridgesBelow { get; set; }
        public int? insp_nMicrowaves { get; set; }
        public int? insp_microwavesTotalRate { get; set; }
        public int? insp_nMicrowavesBelow { get; set; }
        public int? insp_nShowers { get; set; }
        public int? insp_showersTotalRate { get; set; }
        public int? insp_nShowersBelow { get; set; }
        public int? insp_nSinks { get; set; }
        public int? insp_sinksTotalRate { get; set; }
        public int? insp_nSinksBelow { get; set; }
        public int? insp_nLckCupboards { get; set; }
        public int? insp_nLckCupboardsShelves { set; get; }
        public int? insp_lckCupboardstotalRate { get; set; }
        public int? insp_nLckCupboardsBelow { get; set; }
        public int? insp_nCntrTops { get; set; }
        public int? insp_cntrTopsTotalRate { get; set; }
        public int? insp_nCntrTopsBelow { get; set; }
        public int? insp_nStoves { get; set; }
        public int? insp_nStovePlates { get; set; }
        public int? insp_stovesTotalRate { get; set; }
        public int? insp_nStovesBelow { get; set; }
        public int? insp_nLaundryFac { get; set; }
        public int? insp_laundryFacTotalRate { get; set; }
        public int? insp_nLaundryFacBelow { get; set; }
        public int? insp_nToilets { get; set; }
        public int? insp_toiletstotalRate { get; set; }
        public int? insp_nToiletsBelow { get; set; }
        public int? insp_nBasins { get; set; }
        public int? insp_basinsTotalRate { get; set; }
        public int? insp_nBasinsBelow { get; set; }
        public int? insp_nSheBins { get; set; }
        public int? insp_sheBinsTotalRate { get; set; }
        public int? insp_nSheBinsBelow { get; set; }
        public bool? insp_extinguishers { get; set; }
        public bool? insp_dbBrdSign { get; set; }
        public bool? insp_exitDoors { get; set; }
        public bool? insp_smkDetect { get; set; }
        public bool? insp_fireBlankets { get; set; }
        public bool? insp_emgyNum { get; set; }
        public bool? insp_fireAlarm { get; set; }
        public bool? insp_emgyExitRoute { get; set; }
        public bool? insp_emgySigns { get; set; }
        public bool? insp_fireEqptSign { get; set; }
        public bool? insp_firstAid { get; set; }
        public bool? insp_fence { get; set; }
        public bool? insp_gates { get; set; }
        public bool? insp_panicBTN { get; set; }
        public bool? insp_cctv { get; set; }
        public bool? insp_burglarProof { get; set; }
        public bool? insp_armedResp { get; set; }
        public bool? insp_roomLocks { get; set; }
        public bool? insp_security { get; set; }
        public bool? insp_lighting { get; set; }
        public string insp_commentSection { get; set; }
        

    }
}
