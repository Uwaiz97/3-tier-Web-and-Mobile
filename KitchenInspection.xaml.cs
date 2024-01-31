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
    public partial class KitchenInspection : ContentPage
    {
        //Stove
        private int totPlates = 0;
        private double totStoveRate = 0;
        private int stoveLessThan = 0;
        private int numStoves = 0;

        //Fridge
        private int fridgeTotRate = 0;
        private int nFridges = 0;
        private int fridgeLessThan = 0;

        //Microwave
        private int microwaveTotRate = 0;
        private int nMicrowave = 0;
        private int microwaveLessThan = 0;

        //Washing Machine
        private int washingTotRate = 0;
        private int nWashing = 0;
        private int washingLessThan = 0;

        //Dryer
        private int dryerTotRate = 0;
        private int nDryer = 0;
        private int dryerLessThan = 0;

        //Cupboards
        private int cupboardTotRate = 0;
        private int nCupboard = 0;
        private int cupboardLessThan = 0;
        private int numCupboard = 0;

        //Kitchen comment
        private string kitchenComent = "";

        private int user_id;
        private string ipAddress;
        private int insp_id;
        private Inspection inspection;

        private int nKitchenInspected;
        public KitchenInspection(int id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            this.user_id = id;
            this.ipAddress = ipAddress;
            this.insp_id = insp_id;
            initializeData();
        }



        private async void initializeData()
        {
            HttpClient client = new HttpClient();
            var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id);

            Inspection inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (inspection.insp_nSinks > 0)
            {
                nKitchenInspected = (int)inspection.insp_nSinks;
                await DisplayAlert("Message", "You already inspected " + nKitchenInspected + " Kitchen", "Ok");
                nKitchenInspected = nKitchenInspected + 1;
                kitchenNum.Text = "Kitchen Number: " + nKitchenInspected.ToString();
                nKitchenInspected = nKitchenInspected - 1;
                updateData(inspection);
            }
            else
            {
                kitchenNum.Text = "Kitchen Number: " + 1.ToString();
            }

        }

        private void updateData(Inspection inspection)
        {
            nKitchenInspected = (int)inspection.insp_nSinks;

            this.totPlates = (int)inspection.insp_nStovePlates;
                this.totStoveRate = (int)inspection.insp_stovesTotalRate;
                this.stoveLessThan = (int)inspection.insp_nStovesBelow;

                this.nFridges = (int)inspection.insp_nFridges;
                this.fridgeTotRate = (int)inspection.insp_fridgesTotalRate;
                this.fridgeLessThan = (int)inspection.insp_nFridgesBelow;

                this.nMicrowave = (int)inspection.insp_nMicrowaves;
                this.microwaveTotRate = (int)inspection.insp_microwavesTotalRate;
                this.microwaveLessThan = (int)inspection.insp_nMicrowavesBelow;

                this.nWashing = (int)inspection.insp_nLaundryFac + nWashing;
                this.washingLessThan = (int)inspection.insp_nLaundryFacBelow;
                this.washingTotRate = (int)inspection.insp_laundryFacTotalRate;

                this.nCupboard = (int)inspection.insp_nLckCupboardsShelves;
                this.cupboardTotRate = (int)inspection.insp_lckCupboardstotalRate;
                this.cupboardLessThan = (int)inspection.insp_nLckCupboardsBelow;

            this.kitchenComent = inspection.insp_commentSection;
        }

        private void Kitchen()
        {
            //Stove Totals
            if(stoveGood.IsChecked == true)
            {
                totStoveRate = totStoveRate + 2;
            }else if (stoveUsable.IsChecked == true)
            {
                totStoveRate = totStoveRate + 1;
            }else if(stoveUnusable.IsChecked == true)
            {
                totStoveRate = totStoveRate + 0;
                stoveLessThan = stoveLessThan + 1;
            }
            totPlates = totPlates + Convert.ToInt32(txtStovePlates.Text);

            //Fridges
            if (fridgeGood.IsChecked == true)
            {
                fridgeTotRate = fridgeTotRate + 2;
            }
            else if (fridgeUsable.IsChecked == true)
            {
                fridgeTotRate = fridgeTotRate + 1;
            }
            else if (fridgeUnusable.IsChecked == true)
            {
                fridgeTotRate = fridgeTotRate + 0;
                fridgeLessThan = fridgeLessThan + 1;
            }
            nFridges = nFridges + Convert.ToInt32(txtFridges.Text);

            //Microwave
            if (microwaveGood.IsChecked == true)
            {
                microwaveTotRate = microwaveTotRate + 2;
            }
            else if (microwaveUsable.IsChecked == true)
            {
                microwaveTotRate = microwaveTotRate + 1;
            }
            else if (microwaveUnusable.IsChecked == true)
            {
                microwaveTotRate = microwaveTotRate + 0;
                microwaveLessThan = microwaveLessThan + 1;
            }
            nMicrowave = nMicrowave + Convert.ToInt32(txtMicrowave.Text);

            //Machine
            if (washingGood.IsChecked == true)
            {
                washingTotRate = washingTotRate + 2;
            }
            else if (washingUsable.IsChecked == true)
            {
                washingTotRate = washingTotRate + 1;
            }
            else if (washingUnusable.IsChecked == true)
            {
                washingTotRate = washingTotRate + 0;
                washingLessThan = washingLessThan + 1;
            }
            nWashing = nWashing + Convert.ToInt32(txtMachine.Text);

            //Dryer
            if (dryerGood.IsChecked == true)
            {
                dryerTotRate = dryerTotRate + 2;
            }
            else if (dryerUsable.IsChecked == true)
            {
                dryerTotRate = dryerTotRate + 1;
            }
            else if (dryerUnusable.IsChecked == true)
            {
                dryerTotRate = dryerTotRate + 0;
                dryerLessThan = dryerLessThan + 1;
            }
            nDryer = nDryer + Convert.ToInt32(txtDryers.Text);

            //Cupboards
            if (cupboardGood.IsChecked == true)
            {
                cupboardTotRate = cupboardTotRate + 2;
            }
            else if (cupboardUsable.IsChecked == true)
            {
                cupboardTotRate = cupboardTotRate + 1;
            }
            else if (cupboardUnusable.IsChecked == true)
            {
                cupboardTotRate = cupboardTotRate + 0;
                cupboardLessThan = cupboardLessThan + 1;
            }
            nCupboard = nCupboard + Convert.ToInt32(txtCupboadShelves.Text);

            if(txtComment.Text != null)
            kitchenComent = kitchenComent + "oca/kitchen/" + txtComment.Text+"/";
        }

   
        private void savedata(Inspection inspection)
        {
            inspection.insp_nSinks = nKitchenInspected;
            inspection.insp_nStovePlates = (int)totPlates;
            inspection.insp_stovesTotalRate = (int)totStoveRate;
            inspection.insp_nStovesBelow = (int)stoveLessThan;

            inspection.insp_nFridges = (int)nFridges;
            inspection.insp_fridgesTotalRate = (int)fridgeTotRate;
            inspection.insp_nFridgesBelow = (int)fridgeLessThan;

            inspection.insp_nMicrowaves = (int)nMicrowave;
            inspection.insp_microwavesTotalRate = (int)microwaveTotRate;
            inspection.insp_nMicrowavesBelow = (int)microwaveLessThan;

            inspection.insp_nLaundryFac = (int)nWashing + nDryer;
            inspection.insp_nLaundryFacBelow = (int)washingLessThan + (int)dryerLessThan;
            inspection.insp_laundryFacTotalRate = (int)washingTotRate + (int)dryerTotRate;

            inspection.insp_nLckCupboardsShelves = (int)nCupboard;
            inspection.insp_lckCupboardstotalRate = (int)cupboardTotRate;
            inspection.insp_nLckCupboardsBelow = (int)cupboardLessThan;

            inspection.insp_nLckCupboards = numCupboard;
            inspection.insp_nStoves = numStoves;
            inspection.insp_commentSection = kitchenComent;

        }


        private void Add_Kitchen(object sender, EventArgs e)
        {
            //Stove
            if (stoveYes.IsChecked == false && stoveNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Stove's availability", "Ok");
                return;
            }
            if (stoveYes.IsChecked == true && (stoveGood.IsChecked == false && stoveUnusable.IsChecked == false && stoveUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Stove's condition", "Ok");
                return;
            }
            if (stoveYes.IsChecked == true && string.IsNullOrEmpty(txtStovePlates.Text)){
                DisplayAlert("Message", "Provide number of Stoves", "Ok");
                return;
            }

            //Fridge
            if (fridgeYes.IsChecked == false && fridgerNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Fridge's availability", "Ok");
                return;
            }
            if (fridgeYes.IsChecked == true && (fridgeGood.IsChecked == false && fridgeUnusable.IsChecked == false && fridgeUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Fridge's condition", "Ok");
                return;
            }
            if (fridgeYes.IsChecked == true && string.IsNullOrEmpty(txtFridges.Text))
            {
                DisplayAlert("Message", "Provide number of Fridges", "Ok");
                return;
            }

            //Microwaves
            if (microwaveYes.IsChecked == false && microwaveNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Microwave's availability", "Ok");
                return;
            }
            if (microwaveYes.IsChecked == true && (microwaveGood.IsChecked == false && microwaveUnusable.IsChecked == false && microwaveUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Microwave's condition", "Ok");
                return;
            }
            if (microwaveYes.IsChecked == true && string.IsNullOrEmpty(txtMicrowave.Text))
            {
                DisplayAlert("Message", "Provide number of Microwaves", "Ok");
                return;
            }

            //Washing Machine
            if (washingYes.IsChecked == false && washingNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Washing Machine's availability", "Ok");
                return;
            }
            if (washingYes.IsChecked == true && (washingGood.IsChecked == false && washingUnusable.IsChecked == false && washingUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Washing Machine's condition", "Ok");
                return;
            }
            if (washingYes.IsChecked == true && string.IsNullOrEmpty(txtMachine.Text))
            {
                DisplayAlert("Message", "Provide number of Washing Machines", "Ok");
                return;
            }


            //Dryer
            if (dryerYes.IsChecked == false && dryerNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Dryer's availability", "Ok");
                return;
            }
            if (dryerYes.IsChecked == true && (dryerGood.IsChecked == false && dryerUnusable.IsChecked == false && dryerUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Dryer's condition", "Ok");
                return;
            }
            if (dryerYes.IsChecked == true && string.IsNullOrEmpty(txtDryers.Text))
            {
                DisplayAlert("Message", "Provide number of Dryers", "Ok");
                return;
            }

            //Cupboards
            if (cupboardYes.IsChecked == false && cupboardNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Lockable Cupboard's availability", "Ok");
                return;
            }
            if (cupboardYes.IsChecked == true && (cupboardGood.IsChecked == false && cupboardUnusable.IsChecked == false && cupboardUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Lockable Cupboard's condition", "Ok");
                return;
            }
            if (cupboardYes.IsChecked == true && string.IsNullOrEmpty(txtDryers.Text))
            {
                DisplayAlert("Message", "Provide number of Lockable Cupboards", "Ok");
                return;
            }
            nKitchenInspected = nKitchenInspected+1;

            Kitchen();

            DisplayAlert("Message", "Kitchen Successfully Added", "Ok");

            this.nKitchenInspected = nKitchenInspected + 1;
            //roomnNum++;
            kitchenNum.Text = "Kitchen Number: " + nKitchenInspected.ToString();
            clearPage();
        }

        private void clearPage()
        {
            txtComment.Text = null;
            //Stove
            stoveYes.IsChecked = false;
            stoveNo.IsChecked = false;
            stoveGood.IsChecked = false;
            stoveUsable.IsChecked = false;
            stoveUnusable.IsChecked = false;
            txtStovePlates.Text = null;

            //Fridge
            fridgeYes.IsChecked = false;
            fridgerNo.IsChecked = false;
            fridgeGood.IsChecked = false;
            fridgeUsable.IsChecked = false;
            fridgeUnusable.IsChecked = false;
            txtFridges.Text = null;

            //Microwave
            microwaveYes.IsChecked = false;
            microwaveNo.IsChecked = false;
            microwaveGood.IsChecked = false;
            microwaveUsable.IsChecked = false;
            microwaveUnusable.IsChecked = false;
            txtMicrowave.Text = null;

            //Washing
            washingYes.IsChecked = false;
            washingNo.IsChecked = false;
            washingGood.IsChecked = false;
            washingUsable.IsChecked = false;
            washingUnusable.IsChecked = false;
            txtMachine.Text = null;

            //Dryer
            dryerYes.IsChecked = false;
            dryerNo.IsChecked = false;
            dryerGood.IsChecked = false;
            dryerUsable.IsChecked = false;
            dryerUnusable.IsChecked = false;
            txtDryers.Text = null;

            //Lockable Cupboards
            cupboardYes.IsChecked = false;
            cupboardNo.IsChecked = false;
            cupboardGood.IsChecked = false;
            cupboardUsable.IsChecked = false;
            cupboardUnusable.IsChecked = false;
            txtCupboadShelves.Text = null;
        }

        //private async void update()
        //{
        //    HttpClient client = new HttpClient();
        //    var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id);

        //    var inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

        //    if (inspection.insp_nShowers != null)
        //    {
        //        this.totPlates = (int)inspection.insp_nStovePlates + this.totPlates;
        //        this.totStoveRate = (int)inspection.insp_stovesTotalRate + totStoveRate;
        //        this.stoveLessThan = (int)inspection.insp_nStovesBelow + stoveLessThan;

        //        this.nFridges = (int)inspection.insp_nFridges + nFridges;
        //        this.fridgeTotRate = (int)inspection.insp_fridgesTotalRate + fridgeTotRate;
        //        this.fridgeLessThan = (int)inspection.insp_nFridgesBelow + fridgeLessThan;

        //        this.nMicrowave = (int)inspection.insp_nMicrowaves + nMicrowave;
        //        this.microwaveTotRate = (int)inspection.insp_microwavesTotalRate + microwaveTotRate;
        //        this.microwaveLessThan = (int)inspection.insp_nMicrowavesBelow + microwaveLessThan;

        //        this.nWashing = (int)inspection.insp_nLaundryFac + nWashing + nDryer;
        //        this.washingLessThan = (int)inspection.insp_nLaundryFacBelow + washingLessThan + dryerLessThan;
        //        this.washingTotRate = (int)inspection.insp_laundryFacTotalRate + washingTotRate + dryerTotRate;

        //        this.nCupboard = (int)inspection.insp_nLckCupboardsShelves + nCupboard;
        //        this.cupboardTotRate = (int)inspection.insp_lckCupboardstotalRate + cupboardTotRate;
        //        this.cupboardLessThan = (int)inspection.insp_nLckCupboardsBelow + cupboardLessThan;
        //    }
        //}



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
            await Navigation.PushAsync(new AcceptedInpections(this.user_id, this.ipAddress));
        }

        private async void InspectBedroom(object sender, EventArgs e)
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

                await Navigation.PushAsync((new Inpect(this.user_id, this.ipAddress, this.insp_id)));
            }
            else
            {
                await Navigation.PushAsync((new Inpect(this.user_id, this.ipAddress, this.insp_id)));
            }

        }

        private async void InspectBathRoom(object sender, EventArgs e)
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

                await Navigation.PushAsync((new BathRoom(this.user_id, this.ipAddress, this.insp_id)));
            }
            else
            {
                await Navigation.PushAsync((new BathRoom(this.user_id, this.ipAddress, this.insp_id)));
            }
        }

        private void stoveYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (stoveYes.IsChecked)
            {
                stoveNo.IsChecked = false;

                stoveGood.IsEnabled = true;
                stoveUnusable.IsEnabled = true;
                stoveUsable.IsEnabled = true;
                txtStovePlates.IsEnabled = true;
            }
        }

        private void stoveNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (stoveNo.IsChecked)
            {
                stoveYes.IsChecked = false;

                stoveGood.IsEnabled = false;
                stoveUnusable.IsEnabled = false;
                stoveUsable.IsEnabled = false;

                stoveGood.IsChecked = false;
                stoveUnusable.IsChecked = false;
                stoveUsable.IsChecked = false;

                txtStovePlates.IsEnabled = false;
            }
        }

        private void stoveGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (stoveGood.IsChecked)
            {
                stoveUsable.IsChecked = false;
                stoveUnusable.IsChecked = false;
            }
        }

        private void stoveUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (stoveUsable.IsChecked)
            {
                stoveGood.IsChecked = false;
                stoveUnusable.IsChecked = false;
            }
        }

        private void stoveUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (stoveUnusable.IsChecked)
            {
                stoveGood.IsChecked = false;
                stoveUsable.IsChecked = false;
            }
        }

        private void fridgeYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fridgeYes.IsChecked)
            {
                fridgerNo.IsChecked = false;

                fridgeGood.IsEnabled = true;
                fridgeUnusable.IsEnabled = true;
                fridgeUsable.IsEnabled = true;
                txtStovePlates.IsEnabled = true;
            }
        }

        private void fridgerNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fridgerNo.IsChecked)
            {
                fridgeYes.IsChecked = false;

                fridgeGood.IsEnabled = false;
                fridgeUnusable.IsEnabled = false;
                fridgeUsable.IsEnabled = false;

                fridgeGood.IsChecked = false;
                fridgeUnusable.IsChecked = false;
                fridgeUsable.IsChecked = false;
                txtFridges.IsEnabled = false;
            }
        }

        private void fridgeGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fridgeGood.IsChecked)
            {
                fridgeUnusable.IsChecked = false;
                fridgeUsable.IsChecked = false;
            }
        }

        private void fridgeUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fridgeUsable.IsChecked)
            {
                fridgeGood.IsChecked = false;
                fridgeUnusable.IsChecked = false;
            }
        }

        private void fridgeUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fridgeUnusable.IsChecked)
            {
                fridgeGood.IsChecked = false;
                fridgeUsable.IsChecked = false;
            }
        }

        private void microwavesYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (microwaveYes.IsChecked)
            {
                microwaveNo.IsChecked = false;

                microwaveGood.IsEnabled = true;
                microwaveUnusable.IsEnabled = true;
                microwaveUsable.IsEnabled = true;
                txtMicrowave.IsEnabled = true;
            }
        }

        private void microwaveNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (microwaveNo.IsChecked)
            {
                microwaveYes.IsChecked = false;

                microwaveGood.IsEnabled = false;
                microwaveUnusable.IsEnabled = false;
                microwaveUsable.IsEnabled = false;

                microwaveGood.IsChecked = false;
                microwaveUnusable.IsChecked = false;
                microwaveUsable.IsChecked = false;
                txtMicrowave.IsEnabled = false;
            }
        }

        private void microwaveGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (microwaveGood.IsChecked)
            {
                microwaveUnusable.IsChecked = false;
                microwaveUsable.IsChecked = false;
            }
        }

        private void microwaveUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (microwaveUsable.IsChecked)
            {
                microwaveUnusable.IsChecked = false;
                microwaveGood.IsChecked = false;
            }
        }

        private void microwaveUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (microwaveUnusable.IsChecked)
            {
                microwaveUsable.IsChecked = false;
                microwaveGood.IsChecked = false;
            }
        }

        private void washingYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (washingYes.IsChecked)
            {
                washingNo.IsChecked = false;

                washingGood.IsEnabled = true;
                washingUnusable.IsEnabled = true;
                washingUsable.IsEnabled = true;
                txtMachine.IsEnabled = true;
            }
        }

        private void washingNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (washingNo.IsChecked)
            {
                washingYes.IsChecked = false;

                washingGood.IsEnabled = false;
                washingUnusable.IsEnabled = false;
                washingUsable.IsEnabled = false;

                washingGood.IsChecked = false;
                washingUnusable.IsChecked = false;
                washingUsable.IsChecked = false;
                txtMachine.IsEnabled = false;
            }
        }

        private void washingGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (washingGood.IsChecked)
            {
                washingUsable.IsChecked = false;
                washingUnusable.IsChecked = false;
            }
        }

        private void washingUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (washingUsable.IsChecked)
            {
                washingUnusable.IsChecked = false;
                washingGood.IsChecked = false;
            }
        }

        private void washingUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (washingUnusable.IsChecked)
            {
                washingUsable.IsChecked = false;
                washingGood.IsChecked = false;
            }
        }

        private void dryerUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (dryerUnusable.IsChecked)
            {
                dryerUsable.IsChecked = false;
                dryerGood.IsChecked = false;
            }
        }

        private void dryerUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (dryerUsable.IsChecked)
            {
                dryerUnusable.IsChecked = false;
                dryerGood.IsChecked = false;
            }
        }

        private void dryerGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (dryerGood.IsChecked)
            {
                dryerUsable.IsChecked = false;
                dryerUnusable.IsChecked = false;
            }
        }

        private void dryerNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (dryerNo.IsChecked)
            {
                dryerYes.IsChecked = false;

                dryerGood.IsEnabled = false;
                dryerUnusable.IsEnabled = false;
                dryerUsable.IsEnabled = false;

                dryerGood.IsChecked = false;
                dryerUnusable.IsChecked = false;
                dryerUsable.IsChecked = false;
                txtDryers.IsEnabled = false;
            }
        }

        private void dryerYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (dryerYes.IsChecked)
            {
                dryerNo.IsChecked = false;

                dryerGood.IsEnabled = true;
                dryerUnusable.IsEnabled = true;
                dryerUsable.IsEnabled = true;
                txtDryers.IsEnabled = true;
            }
        }

        private void cupboardYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cupboardYes.IsChecked)
            {
                cupboardNo.IsChecked = false;

                cupboardGood.IsEnabled = true;
                cupboardUnusable.IsEnabled = true;
                cupboardUsable.IsEnabled = true;
                txtCupboadShelves.IsEnabled = true;
            }
        }

        private void cupboardNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cupboardNo.IsChecked)
            {
                cupboardYes.IsChecked = false;

                cupboardGood.IsEnabled = false;
                cupboardUnusable.IsEnabled = false;
                cupboardUsable.IsEnabled = false;

                cupboardGood.IsChecked = false;
                cupboardUnusable.IsChecked = false;
                cupboardUsable.IsChecked = false;
                txtCupboadShelves.IsEnabled = false;
            }
        }

        private void cupboardGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cupboardGood.IsChecked)
            {
                cupboardUsable.IsChecked = false;
                cupboardUnusable.IsChecked = false;
            }
        }

        private void cupboardUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cupboardUsable.IsChecked)
            {
                cupboardGood.IsChecked = false;
                cupboardUnusable.IsChecked = false;
            }
        }

        private void cupboardUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cupboardUnusable.IsChecked)
            {
                cupboardGood.IsChecked = false;
                cupboardUsable.IsChecked = false;
            }
        }
    }
}