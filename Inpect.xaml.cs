using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Inspector
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class Inpect : ContentPage
	{
        private int userId;
        private string ipAddress;
        private int insp_id;

        //Beds
        private int? bedTotCondition = 0;
        private int? nUsableBeds = 0;
        private int? nGoodBeds = 0;
        private int? nUnusableBeds = 0;

        //Heater
        private int? heaterTotCondition = 0;
        private int? nUsableHeaters = 0;
        private int? nGoodHeater = 0;
        private int? nUnusableHeater = 0;

        //Light
        private int? lightTotCondition = 0;
        private int? nUsableLight = 0;
        private int? nGoodLights = 0;
        private int? nUnusableLights = 0;

        //Table
        private int? tableTotCondition = 0;
        private int? nUsableTable = 0;
        private int? nGoodTable = 0;
        private int? nUnusableTable = 0;

        //Bookshelve
        private int? bookshelveTotCondition = 0;
        private int? nUsableBookshelve = 0;
        private int? nGoodBookshelve = 0;
        private int? nUnusableBookshelve = 0;

        //Wadrobe
        private int? wadrobeTotCondition = 0;
        private int? nUsableWadrobe = 0;
        private int? nGoodWadrobe = 0;
        private int? nUnusableWadrobe = 0;

        //Bin
        private int? binTotCondition = 0;
        private int? nUsableBin = 0;
        private int? nGoodBin = 0;
        private int? nUnusableBin = 0;

        //Curtains
        private int? curtainsTotCondition = 0;
        private int? nUsableCurtains = 0;
        private int? nGoodCurtains = 0;
        private int? nUnusableCurtains = 0;

        //Chairs
        private int? chairsTotCondition = 0;
        private int? nUsableChairs = 0;
        private int? nGoodChairs = 0;
        private int? nUnusableChairs = 0;

        private int roomnNum = 1;
        public int totRoomsInspected = 0; //Total number of inspected rooms

        //Total number of inspected beds
        private int? totBed = 0;
        private int? totHeater = 0;
        private int? totLight = 0;
        private int? totTable = 0;
        private int? totBookshelve = 0;
        private int? totWadrobe = 0;
        private int? totBin = 0;
        private int? totCurtains = 0;
        private int? totChairs = 0;

        //Bedroom comment
        private string bedRoomComment = "";

        private int nRoomss = 0;


        public Inpect(int id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            btnRedirectToBathRoom.IsEnabled = true;
            this.userId = id;
            this.ipAddress = ipAddress;
            this.insp_id = insp_id;
            initializeData();
            
        }

        private async void initializeData()
        {
            HttpClient client = new HttpClient();
            var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id);

            Inspection inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (inspection.insp_ocaBeds > 0)
            {
                totRoomsInspected = (int)inspection.insp_ocaBeds;
                await DisplayAlert("Message", "You already inspected " + totRoomsInspected + " room(s)/beds", "Ok");
                totRoomsInspected = totRoomsInspected + 1;
                roomNumber.Text = "Room Number: " + totRoomsInspected.ToString();
                totRoomsInspected = totRoomsInspected - 1;
                update(inspection);
            }
            else
            {
                roomNumber.Text = "Room Number: " + 1.ToString();
            }

        }

        public void update(Inspection inspection)
        {
            this.totBed = inspection.insp_ocaBeds;

                this.bedTotCondition = inspection.insp_matrassTotalRate;
                this.nUnusableBeds = inspection.insp_nMatrassBelow;

                this.totCurtains = inspection.insp_nCurtains;
                this.curtainsTotCondition = inspection.insp_curtainsTotalRate;
                this.nUnusableCurtains = inspection.insp_nCurtainsBelow;

                this.totBin = inspection.insp_nPaperBins;
                this.binTotCondition = inspection.insp_paperBinsTotalRate;
                this.nUnusableBin = inspection.insp_nPaperBinsBelow;

                this.totBookshelve = inspection.insp_nBookshelves;
                this.bookshelveTotCondition = inspection.insp_bookshTotalRate;
                this.nUnusableBookshelve = inspection.insp_nBookshelvesBelow;

                this.totTable = inspection.insp_nDesks;
                this.tableTotCondition = inspection.insp_desksTotalRate;
                this.nUnusableTable = inspection.insp_nDesksBelow;

                this.totChairs = inspection.insp_nChairs;
                this.chairsTotCondition = inspection.insp_chairsTotalRate;
                this.nUnusableChairs = inspection.insp_nChairsBelow;

                this.totWadrobe = inspection.insp_nWardrobes;
                this.wadrobeTotCondition = inspection.insp_wardrobesTotalRate;
                this.nUnusableWadrobe = inspection.insp_nWardrobesBelow;

                this.totHeater = inspection.insp_nHeaters;
                this.heaterTotCondition = inspection.insp_heatersTotalRate;
                this.nUnusableHeater = inspection.insp_nHeatersBelow;

                this.totLight = inspection.insp_nStudyLamp;
                this.lightTotCondition = inspection.insp_studyLampTotalRate;
                this.nUnusableLights = inspection.insp_nStudyLampBelow;
                this.bedRoomComment = inspection.insp_commentSection;
        }


        public void calculates()
        {
            totBed = nGoodBeds + nUnusableBeds + nUsableBeds;
            totLight = nGoodLights + nUnusableLights + nUsableLight;
            totHeater = nGoodHeater + nUnusableHeater + nUsableHeaters;
            totTable = nGoodTable + nUnusableTable + nUsableTable;
            totBookshelve = nGoodBookshelve + nUnusableBookshelve + nUsableBookshelve;
            totWadrobe = nGoodWadrobe + nUnusableWadrobe + nUsableWadrobe;
            totBin = nGoodBin + nUnusableBin + nUsableBin;
            totCurtains = nGoodCurtains + nUnusableCurtains + nUsableCurtains;
            totChairs = nGoodChairs + nUsableChairs + nUnusableChairs;
        }


        private void Room()
        {
                //TotalBed
                if (bedGood.IsChecked==true)
                {
                    bedTotCondition = bedTotCondition + 2;
                    nGoodBeds = nGoodBeds + 1;
                }else if (bedUnusable.IsChecked == true)
                {
                    bedTotCondition = bedTotCondition + 0;
                    nUnusableBeds = nUnusableBeds + 1;
                }else if (bedUsable.IsChecked == true)
                {
                    bedTotCondition = bedTotCondition + 1;
                    nUsableBeds = nUsableBeds + 1;
                }

            //TotalHeater
            if (heaterGood.IsChecked)
            {
                heaterTotCondition = heaterTotCondition + 2;
                nGoodHeater = nGoodHeater + 1;
            }
            else if (heaterUnusable.IsChecked)
            {
                heaterTotCondition = heaterTotCondition + 0;
                nUnusableHeater = nUnusableHeater + 1;
            }
            else if (heaterUsable.IsChecked)
            {
                heaterTotCondition = heaterTotCondition + 1;
                nUsableHeaters = nUsableHeaters + 1;
            }

                //TotalLight
                if (lightUsable.IsChecked)
                {
                lightTotCondition = lightTotCondition + 1;
                nUsableLight = nUsableLight + 1;

                }else if (lightUnusable.IsChecked)
                {
                lightTotCondition = lightTotCondition + 0;
                nUnusableLights = nUnusableLights + 1;
                }else if (lightGood.IsChecked){
                lightTotCondition = lightTotCondition + 2;
                nGoodLights = nGoodLights + 1;
                }

                //TotalTable
                if (tableUsable.IsChecked)
                {
                tableTotCondition = tableTotCondition + 1;
                nUsableTable = nUsableTable + 1;
                }else if (tableUnusable.IsChecked)
                {
                tableTotCondition = tableTotCondition + 0;
                nUnusableTable = nUnusableTable + 1;
                }else if (tableGood.IsChecked)
                {
                tableTotCondition = tableTotCondition + 2;
                nGoodTable = nGoodTable + 1;
                }

                //TotalBookshelve
                if (bookshelveUnusable.IsChecked)
                {
                bookshelveTotCondition = bookshelveTotCondition + 0;
                nUnusableBookshelve = nUnusableBookshelve + 1;
                }
                else if (bookshelveUsable.IsChecked)
                {
                bookshelveTotCondition = bookshelveTotCondition + 1;
                nUsableBookshelve = nUsableBookshelve + 1;
                }
                else if (bookshelveGood.IsChecked)
                {
                bookshelveTotCondition = bookshelveTotCondition + 2;
                nGoodBookshelve = nGoodBookshelve + 1;
                }

                //TotalWadrobe
                if (wadrobeUnusable.IsChecked)
                {
                wadrobeTotCondition = wadrobeTotCondition + 0;
                nUnusableWadrobe = nUnusableWadrobe + 1;
                }
                else if (wadrobeUsable.IsChecked)
                {
                wadrobeTotCondition = wadrobeTotCondition + 1;
                nUsableWadrobe = nUsableWadrobe + 1;
                }
                else if (wadrobeGood.IsChecked)
                {
                wadrobeTotCondition = wadrobeTotCondition + 2;
                nGoodWadrobe = nGoodWadrobe + 1;
                }

                //TotalBin
                if (binUnusable.IsChecked)
                {
                binTotCondition = binTotCondition + 0;
                nUnusableBin = nUnusableBin + 1;
                }
                else if (binUsable.IsChecked)
                {
                binTotCondition = binTotCondition + 1;
                nUsableBin = nUsableBin + 1;
                }
                else if (binGood.IsChecked)
                {
                binTotCondition = binTotCondition + 2;
                nGoodBin = nGoodBin + 1;
                }

                //TotalnCurtains
                if (curtainsUnusable.IsChecked)
                {
                curtainsTotCondition = curtainsTotCondition + 0;
                nUnusableCurtains = nUnusableCurtains + 1;
                }
                else if (curtainsUsable.IsChecked)
                {
                curtainsTotCondition = curtainsTotCondition + 1;
                nUsableCurtains = nUsableCurtains + 1;
                }
                else if (curtainsGood.IsChecked)
                {
                curtainsTotCondition = curtainsTotCondition + 2;
                nGoodCurtains = nGoodCurtains + 1;
                }


                //TotalChair
                if (chairUnusable.IsChecked)
                {
                chairsTotCondition = chairsTotCondition + 0;
                nUnusableChairs = nUnusableChairs + 1;
                }
                else if (chairUsable.IsChecked)
                {
                chairsTotCondition = chairsTotCondition + 1;
                nUsableChairs = nUsableChairs + 1;
                }
                else if (chairGood.IsChecked)
                {
                chairsTotCondition = chairsTotCondition + 2;
                nGoodChairs = nGoodChairs + 1;
                }
        }


        private async void AddRoom(object sender, EventArgs e)
        {
            //Bed
            if(bedYes.IsChecked == false && bedNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Bed's availability", "Ok");
                return;
            }
            if (bedYes.IsChecked == true && bedGood.IsChecked == false && bedUnusable.IsChecked == false && bedUsable.IsChecked==false)
            {
                await DisplayAlert("Message", "Provide Bed's condition", "Ok");
                return;
            }

            //Heater
            if (heaterYes.IsChecked == false && heaterNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Heater's availability", "Ok");
                return;
            }
            if (heaterYes.IsChecked == true && heaterGood.IsChecked == false && heaterUnusable.IsChecked == false && heaterUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Heater's condition", "Ok");
                return;
            }

            //Study Light
            if (lightYes.IsChecked == false && lightNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Study Light's availability", "Ok");
                return;
            }
            if (lightYes.IsChecked == true && lightGood.IsChecked == false && lightUnusable.IsChecked == false && lightUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Study Light's condition", "Ok");
                return;
            }

            //Study Table
            if (tableYes.IsChecked == false && tableNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Study Table's availability", "Ok");
                return;
            }
            if (tableYes.IsChecked == true && tableGood.IsChecked == false && tableUnusable.IsChecked == false && tableUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Study Table's condition", "Ok");
                return;
            }

            //Bookshelve
            if (bookshelveYes.IsChecked == false && bookshelveNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Bookshelf's availability", "Ok");
                return;
            }
            if (bookshelveYes.IsChecked == true && bookshelveGood.IsChecked == false && bookshelveUnusable.IsChecked == false && bookshelveUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Bookshelf's condition", "Ok");
                return;
            }

            //wadrobe
            if (wadrobeYes.IsChecked == false && wadrobeNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Wardrobe's availability", "Ok");
                return;
            }
            if (wadrobeYes.IsChecked == true && wadrobeGood.IsChecked == false && wadrobeUnusable.IsChecked == false && wadrobeUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Wardrobe's condition", "Ok");
                return;
            }

            //bin
            if (binYes.IsChecked == false && binNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Paper Bin's availability", "Ok");
                return;
            }
            if (binYes.IsChecked == true && binGood.IsChecked == false && binUnusable.IsChecked == false && binUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Paper Bin's condition", "Ok");
                return;
            }

            //Curtains
            if (curtainsYes.IsChecked == false && curtainsNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Curtains' availability", "Ok");
                return;
            }
            if (curtainsYes.IsChecked == true && curtainsGood.IsChecked == false && curtainsUnusable.IsChecked == false && curtainsUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Curtains' condition", "Ok");
                return;
            }

            //Chairs
            if (chairYes.IsChecked == false && chairNo.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Chair's availability", "Ok");
                return;
            }
            if (chairYes.IsChecked == true && chairGood.IsChecked == false && chairUnusable.IsChecked == false && chairUsable.IsChecked == false)
            {
                await DisplayAlert("Message", "Provide Chair's condition", "Ok");
                return;
            }

            Room();
            //calculates();

            await DisplayAlert("Message", "Room Successfully Added", "Ok");

            this.totRoomsInspected = totRoomsInspected + 1;
            //roomnNum++;
            roomNumber.Text = "Room Number: " + totRoomsInspected.ToString();

            if (txtComment.Text != null)
                bedRoomComment = bedRoomComment + "oca/room/" + txtComment.Text + "/";
            clearPage();

        }
        private void clearPage()
        {
            txtComment.Text = null;
            //(Yes or No) Refresh
            bedNo.IsChecked = false;
            bedYes.IsChecked = false;
            heaterNo.IsChecked = false;
            heaterYes.IsChecked = false;
            lightNo.IsChecked = false;
            lightYes.IsChecked = false;
            tableNo.IsChecked = false;
            tableYes.IsChecked = false;
            bookshelveNo.IsChecked = false;
            bookshelveYes.IsChecked = false;
            wadrobeNo.IsChecked = false;
            wadrobeYes.IsChecked = false;
            binNo.IsChecked = false;
            binYes.IsChecked = false;
            curtainsNo.IsChecked = false;
            curtainsYes.IsChecked = false;
            chairYes.IsChecked = false;
            chairNo.IsChecked = false;

            //Condition
            bedGood.IsChecked = false;
            bedUsable.IsChecked = false;
            bedUnusable.IsChecked = false;

            heaterGood.IsChecked = false;
            heaterUsable.IsChecked = false;
            heaterUnusable.IsChecked = false;

            lightGood.IsChecked = false;
            lightUsable.IsChecked = false;
            lightUnusable.IsChecked = false;

            tableGood.IsChecked = false;
            tableUsable.IsChecked = false;
            tableUnusable.IsChecked = false;


            bookshelveGood.IsChecked = false;
            bookshelveUsable.IsChecked = false;
            bookshelveUnusable.IsChecked = false;

            wadrobeGood.IsChecked = false;
            wadrobeUsable.IsChecked = false;
            wadrobeUnusable.IsChecked = false;

            binGood.IsChecked = false;
            binUsable.IsChecked = false;
            binUnusable.IsChecked = false;

            curtainsGood.IsChecked = false;
            curtainsUsable.IsChecked = false;
            curtainsUnusable.IsChecked = false;

            chairGood.IsChecked = false;
            chairUsable.IsChecked = false;
            chairUnusable.IsChecked = false;
        }
        //private async void update()
        //{

        //    Room();
        //    HttpClient client = new HttpClient();
        //    var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/"+this.insp_id);

        //    var inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

        //    if(inspection.insp_ocaBeds != null)
        //    {
        //        this.totBed = inspection.insp_ocaBeds;
        //        this.totRoomsInspected = (int)this.totBed;

        //        this.totBed = inspection.insp_nMatrass + this.totBed;
        //        this.bedTotCondition = inspection.insp_matrassTotalRate + this.bedTotCondition;
        //        this.nUnusableBeds = inspection.insp_nMatrassBelow + this.nUnusableBeds;

        //        this.totCurtains = inspection.insp_nCurtains + this.totCurtains;
        //        this.curtainsTotCondition = inspection.insp_curtainsTotalRate + this.curtainsTotCondition;
        //        this.nUnusableCurtains = inspection.insp_nCurtainsBelow + this.nUnusableCurtains;

        //        this.totBin = inspection.insp_nPaperBins + this.totBin;
        //        this.binTotCondition = inspection.insp_paperBinsTotalRate + this.binTotCondition;
        //        this.nUnusableBin = inspection.insp_nPaperBinsBelow + this.nUnusableBin;

        //        this.totBookshelve = inspection.insp_nBookshelves + this.totBookshelve;
        //        this.bookshelveTotCondition = inspection.insp_bookshTotalRate + this.bookshelveTotCondition;
        //        this.nUnusableBookshelve = inspection.insp_nBookshelvesBelow + this.nUnusableBookshelve;

        //        this.totTable = inspection.insp_nDesks + this.totTable;
        //        this.tableTotCondition = inspection.insp_desksTotalRate + this.tableTotCondition;
        //        this.nUnusableTable = inspection.insp_nDesksBelow + this.nUnusableTable;

        //        this.totChairs = inspection.insp_nChairs + this.totChairs;
        //        this.chairsTotCondition = inspection.insp_chairsTotalRate + this.chairsTotCondition;
        //        this.nUnusableChairs = inspection.insp_nChairsBelow + this.nUnusableChairs;

        //        this.totWadrobe = inspection.insp_nWardrobes + this.totWadrobe;
        //        this.wadrobeTotCondition = inspection.insp_wardrobesTotalRate + this.wadrobeTotCondition;
        //        this.nUnusableWadrobe = inspection.insp_nWardrobesBelow + this.nUnusableWadrobe;

        //        this.totHeater = inspection.insp_nHeaters + this.totHeater;
        //        this.heaterTotCondition = inspection.insp_heatersTotalRate + this.heaterTotCondition;
        //        this.nUnusableHeater = inspection.insp_nHeatersBelow + this.nUnusableHeater;

        //        this.totLight = inspection.insp_nStudyLamp + this.totLight;
        //        this.lightTotCondition = inspection.insp_studyLampTotalRate + this.lightTotCondition;
        //        this.nUnusableLights = inspection.insp_nStudyLampBelow + this.nUnusableLights;
        //        this.bedRoomComment = inspection.insp_commentSection + this.bedRoomComment;
        //    }
        //}

        private void savedata(Inspection inspection)
        {
            //update();
            calculates();

            inspection.insp_ocaBeds = this.totRoomsInspected;
            inspection.insp_nMatrass = this.totBed;
            inspection.insp_matrassTotalRate = this.bedTotCondition;
            inspection.insp_nMatrassBelow = this.nUnusableBeds;

            inspection.insp_nCurtains = this.totCurtains;
            inspection.insp_curtainsTotalRate = this.curtainsTotCondition;
            inspection.insp_nCurtainsBelow = this.nUnusableCurtains;

            inspection.insp_nPaperBins = this.totBin;
            inspection.insp_paperBinsTotalRate = this.binTotCondition;
            inspection.insp_nPaperBinsBelow = this.nUnusableBin;

            inspection.insp_nBookshelves = this.totBookshelve;
            inspection.insp_bookshTotalRate = this.bookshelveTotCondition;
            inspection.insp_nBookshelvesBelow = this.nUnusableBookshelve;

            inspection.insp_nDesks = this.totTable;
            inspection.insp_desksTotalRate = this.tableTotCondition;
            inspection.insp_nDesksBelow = this.nUnusableTable;

            inspection.insp_nChairs = this.totChairs;
            inspection.insp_chairsTotalRate = this.chairsTotCondition;
            inspection.insp_nChairsBelow = this.nUnusableChairs;

            inspection.insp_nWardrobes = this.totWadrobe;
            inspection.insp_wardrobesTotalRate = this.wadrobeTotCondition;
            inspection.insp_nWardrobesBelow = this.nUnusableWadrobe;

            inspection.insp_nHeaters = this.totHeater;
            inspection.insp_heatersTotalRate = this.heaterTotCondition;
            inspection.insp_nHeatersBelow = this.nUnusableHeater;

            inspection.insp_nStudyLamp = this.totLight;
            inspection.insp_studyLampTotalRate = this.lightTotCondition;
            inspection.insp_nStudyLampBelow = this.nUnusableLights;
            inspection.insp_commentSection = this.bedRoomComment;

        }

        private async void SaveInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            savedata(inspection);

            HttpClient client = new HttpClient();

            string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

            var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
            var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
            {
                Content = stringContent
            };

            HttpResponseMessage response = await client.SendAsync(request);
            string results = await response.Content.ReadAsStringAsync();
            await DisplayAlert("Message", "Inspection saved", "Yes");
        }

        private async void SubmitInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            DateTime date = DateTime.Now;

            if (date != null)
            {
                inspection.insp_ocaDate = date;
            }

            savedata(inspection);

            HttpClient client = new HttpClient();
            string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;
            var getInspections = await client.GetStringAsync(url);

            Inspection insp = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (insp.insp_ohsDate != null && insp.insp_secDate != null)
            {
                inspection.insp_status = "Inspection Completed";
            }

            var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
            var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
            {
                Content = stringContent
            };

            HttpResponseMessage response = await client.SendAsync(request);
            string results = await response.Content.ReadAsStringAsync();
            await DisplayAlert("Message response", "Inspection sucessfully submitted", "OK");
            await Navigation.PushAsync(new AcceptedInpections(this.userId, this.ipAddress));
        }

        private async void InspectKitche(object sender, EventArgs e)
        {
            bool result = await DisplayAlert("Warning", "If you leave this page without saving, the data you alreday captured will be lost.\n Do you want to save before leaving?", "Yes", "No");
            if (result)
            {
                Inspection inspection = new Inspection();

                savedata(inspection);

                HttpClient client = new HttpClient();
                string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

                var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
                var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
                {
                    Content = stringContent
                };

                HttpResponseMessage response = await client.SendAsync(request);
                string results = await response.Content.ReadAsStringAsync();
                await DisplayAlert("Message response", "Inspection sucessfully saved. You can safely go to the next page", "OK");

                await Navigation.PushAsync((new KitchenInspection(this.userId, this.ipAddress, this.insp_id)));
            }
            else
            {
                await Navigation.PushAsync((new KitchenInspection(this.userId, this.ipAddress, this.insp_id)));
            }
        }


        private async void InspectBathroom1(object sender, EventArgs e)
        {
            bool result = await DisplayAlert("Warning", "If you leave this page without saving, the data you alreday captured will be lost.\n Do you want to save before leaving?", "Yes", "No");
            if (result)
            {
                Inspection inspection = new Inspection();

                savedata(inspection);

                HttpClient client = new HttpClient();
                string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

                var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
                var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
                {
                    Content = stringContent
                };

                HttpResponseMessage response = await client.SendAsync(request);
                string results = await response.Content.ReadAsStringAsync();
                await DisplayAlert("Message response", "Inspection sucessfully saved. You can safely go to the next page", "OK");

                await Navigation.PushAsync((new BathRoom(this.userId, this.ipAddress, this.insp_id)));
            }
            else
            {
                await Navigation.PushAsync((new BathRoom(this.userId, this.ipAddress, this.insp_id)));
            }
        }

        private void bedNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bedNo.IsChecked)
            {
                bedYes.IsChecked = false;

                bedGood.IsEnabled = false;
                bedUnusable.IsEnabled = false;
                bedUsable.IsEnabled = false;

                bedGood.IsChecked = false;
                bedUnusable.IsChecked = false;
                bedUsable.IsChecked = false;

            }
        }

        private void bedYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bedYes.IsChecked)
            {
                bedNo.IsChecked = false;
                bedGood.IsEnabled = true;
                bedUnusable.IsEnabled = true;
                bedUsable.IsEnabled = true;
            }

        }

        private void heaterYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (heaterYes.IsChecked)
            {
                heaterNo.IsChecked = false;
                heaterGood.IsEnabled = true;
                heaterUnusable.IsEnabled = true;
                heaterUsable.IsEnabled = true;
            }

        }

        private void heaterNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (heaterNo.IsChecked)
            {
                heaterYes.IsChecked = false;

                heaterGood.IsEnabled = false;
                heaterUnusable.IsEnabled = false;
                heaterUsable.IsEnabled = false;

                heaterGood.IsChecked = false;
                heaterUnusable.IsChecked = false;
                heaterUsable.IsChecked = false;

            }
        }

        private void lightYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightYes.IsChecked)
            {
                lightNo.IsChecked = false;

                lightGood.IsEnabled = true;
                lightUnusable.IsEnabled = true;
                lightUsable.IsEnabled = true;
            }
        }

        private void lightNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightNo.IsChecked)
            {
                lightYes.IsChecked = false;

                lightGood.IsEnabled = false;
                lightUnusable.IsEnabled = false;
                lightUsable.IsEnabled = false;

                lightGood.IsChecked = false;
                lightUnusable.IsChecked = false;
                lightUsable.IsChecked = false;
            }

        }

        private void tableYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (tableYes.IsChecked)
            {
                tableNo.IsChecked = false;

                tableGood.IsEnabled = true;
                tableUnusable.IsEnabled = true;
                tableUsable.IsEnabled = true;
            }

        }

        private void tableNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (tableNo.IsChecked)
            {
                tableYes.IsChecked = false;

                tableGood.IsEnabled = false;
                tableUnusable.IsEnabled = false;
                tableUsable.IsEnabled = false;

                tableGood.IsChecked = false;
                tableUnusable.IsChecked = false;
                tableUsable.IsChecked = false;

            }

        }

        private void bookshelveYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bookshelveYes.IsChecked)
            {
                bookshelveNo.IsChecked = false;

                bookshelveGood.IsEnabled = true;
                bookshelveUnusable.IsEnabled = true;
                bookshelveUsable.IsEnabled = true;
            }

        }

        private void bookshelveNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bookshelveNo.IsChecked)
            {
                bookshelveYes.IsChecked = false;

                bookshelveGood.IsEnabled = false;
                bookshelveUnusable.IsEnabled = false;
                bookshelveUsable.IsEnabled = false;

                bookshelveGood.IsChecked = false;
                bookshelveUnusable.IsChecked = false;
                bookshelveUsable.IsChecked = false;
            }

        }

        private void wadrobeNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (wadrobeNo.IsChecked)
            {
                wadrobeYes.IsChecked = false;

                wadrobeGood.IsEnabled = false;
                wadrobeUnusable.IsEnabled = false;
                wadrobeUsable.IsEnabled = false;

                wadrobeGood.IsChecked = false;
                wadrobeUnusable.IsChecked = false;
                wadrobeUsable.IsChecked = false;
            }
        }

        private void wadrobeYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (wadrobeYes.IsChecked)
            {
                wadrobeNo.IsChecked = false;

                wadrobeGood.IsEnabled = true;
                wadrobeUnusable.IsEnabled = true;
                wadrobeUsable.IsEnabled = true;
            }
        }

        private void binYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (binYes.IsChecked)
            {
                binNo.IsChecked = false;

                binGood.IsEnabled = true;
                binUnusable.IsEnabled = true;
                binUsable.IsEnabled = true;
            }
        }

        private void binNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (binNo.IsChecked)
            {
                binYes.IsChecked = false;

                binGood.IsEnabled = false;
                binUnusable.IsEnabled = false;
                binUsable.IsEnabled = false;

                binGood.IsChecked = false;
                binUnusable.IsChecked = false;
                binUsable.IsChecked = false;
            }

        }

        private void curtainsYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (curtainsYes.IsChecked)
            {
                curtainsNo.IsChecked = false;

                curtainsGood.IsEnabled = true;
                curtainsUnusable.IsEnabled = true;
                curtainsUsable.IsEnabled = true;
            }

        }

        private void curtainsNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (curtainsNo.IsChecked)
            {
                curtainsYes.IsChecked = false;

                curtainsGood.IsEnabled = false;
                curtainsUnusable.IsEnabled = false;
                curtainsUsable.IsEnabled = false;

                curtainsGood.IsChecked = false;
                curtainsUnusable.IsChecked = false;
                curtainsUsable.IsChecked = false;
            }

        }

        private void chairsNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (chairNo.IsChecked)
            {
                chairYes.IsChecked = false;

                chairGood.IsEnabled = false;
                chairUnusable.IsEnabled = false;
                chairUsable.IsEnabled = false;

                chairGood.IsChecked = false;
                chairUnusable.IsChecked = false;
                chairUsable.IsChecked = false;
            }
        }

        private void chairYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (chairYes.IsChecked)
            {
                chairNo.IsChecked = false;

                chairGood.IsEnabled = true;
                chairUnusable.IsEnabled = true;
                chairUsable.IsEnabled = true;
            }
        }

        //Condition
        private void bedGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bedGood.IsChecked)
            {
                bedUsable.IsChecked = false;
                bedUnusable.IsChecked = false;
            }
        }

        private void bedUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bedUsable.IsChecked)
            {
                bedGood.IsChecked = false;
                bedUnusable.IsChecked = false;
            }
        }

        private void bedUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bedUnusable.IsChecked)
            {
                bedGood.IsChecked = false;
                bedUsable.IsChecked = false;
            }
        }

        private void heaterGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (heaterGood.IsChecked)
            {
                heaterUsable.IsChecked = false;
                heaterUnusable.IsChecked = false;
            }

        }

        private void heaterUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (heaterUsable.IsChecked)
            {
                heaterGood.IsChecked = false;
                heaterUnusable.IsChecked = false;
            }
        }

        private void heaterUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (heaterUnusable.IsChecked)
            {
                heaterGood.IsChecked = false;
                heaterUsable.IsChecked = false;
            }
        }

        private void lightGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightGood.IsChecked)
            {
                lightUsable.IsChecked = false;
                lightUnusable.IsChecked = false;
            }
        }

        private void lightUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightUsable.IsChecked)
            {
                lightGood.IsChecked = false;
                lightUnusable.IsChecked = false;
            }
        }

        private void lightUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightUnusable.IsChecked)
            {
                lightGood.IsChecked = false;
                lightUsable.IsChecked = false;
            }
        }

        private void tableGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (tableGood.IsChecked)
            {
                tableUsable.IsChecked = false;
                tableUnusable.IsChecked = false;
            }
        }

        private void tableUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (tableUsable.IsChecked)
            {
                tableGood.IsChecked = false;
                tableUnusable.IsChecked = false;
            }
        }

        private void tableUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (tableUnusable.IsChecked)
            {
                tableGood.IsChecked = false;
                tableUsable.IsChecked = false;
            }
        }

        private void bookshelveGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bookshelveGood.IsChecked)
            {
                bookshelveUsable.IsChecked = false;
                bookshelveUnusable.IsChecked = false;
            }
        }

        private void bookshelveUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bookshelveUsable.IsChecked)
            {
                bookshelveGood.IsChecked = false;
                bookshelveUnusable.IsChecked = false;
            }
        }

        private void bookshelveUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (bookshelveUnusable.IsChecked)
            {
                bookshelveGood.IsChecked = false;
                bookshelveUsable.IsChecked = false;
            }
        }

        private void wadrobeGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (wadrobeGood.IsChecked)
            {
                wadrobeUsable.IsChecked = false;
                wadrobeUnusable.IsChecked = false;
            }
        }

        private void wadrobeUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (wadrobeUsable.IsChecked)
            {
                wadrobeGood.IsChecked = false;
                wadrobeUnusable.IsChecked = false;
            }
        }

        private void wadrobeeUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (wadrobeUnusable.IsChecked)
            {
                wadrobeGood.IsChecked = false;
                wadrobeUsable.IsChecked = false;
            }
        }

        private void binGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (binGood.IsChecked)
            {
                binUsable.IsChecked = false;
                binUnusable.IsChecked = false;
            }
        }

        private void binUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (binUsable.IsChecked)
            {
                binGood.IsChecked = false;
                binUnusable.IsChecked = false;
            }
        }

        private void binUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (binUnusable.IsChecked)
            {
                binGood.IsChecked = false;
                binUsable.IsChecked = false;
            }
        }

        private void curtainsUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (curtainsUnusable.IsChecked)
            {
                curtainsUsable.IsChecked = false;
                curtainsGood.IsChecked = false;
            }
        }

        private void curtainsUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (curtainsUsable.IsChecked)
            {
                curtainsGood.IsChecked = false;
                curtainsUnusable.IsChecked = false;
            }
        }

        private void curtainsGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (curtainsGood.IsChecked)
            {
                curtainsUsable.IsChecked = false;
                curtainsUnusable.IsChecked = false;
            }
        }

        private void chairGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (chairGood.IsChecked)
            {
                chairUnusable.IsChecked = false;
                chairUsable.IsChecked = false;
            }
        }

        private void chairUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (chairUsable.IsChecked)
            {
                chairUnusable.IsChecked = false;
                chairGood.IsChecked = false;
            }
        }

        private void chairUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (chairUnusable.IsChecked)
            {
                chairUsable.IsChecked = false;
                chairGood.IsChecked = false;
            }
        }
    }
}