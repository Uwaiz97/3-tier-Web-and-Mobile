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
    public partial class BathRoom : ContentPage
    {
        private int user_id;
        private int insp_id;
        private string ipAddress;


        //Shower
        private int showerTotRate = 0;
        private int nShower = 0;
        private int showerLessThan = 0;

        //Toilet
        private int toiletTotRate = 0;
        private int nToilets = 0;
        private int toiletLessThan = 0;

        //Basin
        private int basinTotRate = 0;
        private int nBasin = 0;
        private int basinLessThan = 0;

        //She Bin
        private int she_BinTotRate = 0;
        private int nShe_Bin = 0;
        private int she_BinLessThan = 0;

        public int nBathRoomsInpected;
        //She bin comment
        private string bathRoomComment = "";
        public BathRoom(int user_id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            this.user_id = user_id;
            this.insp_id = insp_id;
            this.ipAddress = ipAddress;
            initializeData();
        }
        private async void initializeData()
        {
            HttpClient client = new HttpClient();
            var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id);

            Inspection inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (inspection.insp_nCntrTops > 0)
            {
                nBathRoomsInpected = (int)inspection.insp_nCntrTops;
                await DisplayAlert("Message", "You already inspected " + nBathRoomsInpected + " bathrooms", "Ok");
                nBathRoomsInpected = nBathRoomsInpected + 1;
                bathRoomNum.Text = "Bathroom Number: " + nBathRoomsInpected.ToString();
                nBathRoomsInpected = nBathRoomsInpected - 1;
                updateData(inspection);
            }
            else
            {
                bathRoomNum.Text = "Bathroom Number: " + 1.ToString();
            }

        }

        public void updateData(Inspection inspection)
        {
            nBathRoomsInpected = (int)inspection.insp_nCntrTops;
                this.nShower = (int)inspection.insp_nShowers;
                this.showerTotRate = (int)inspection.insp_showersTotalRate;
                this.showerLessThan = (int)inspection.insp_nShowersBelow ;

                this.nToilets = (int)inspection.insp_nToilets + nToilets;
                this.toiletTotRate = (int)inspection.insp_toiletstotalRate ;
                this.toiletLessThan = (int)inspection.insp_nToiletsBelow ;

                this.nBasin = (int)inspection.insp_nBasins ;
                this.basinTotRate = (int)inspection.insp_basinsTotalRate ;
                this.basinLessThan = (int)inspection.insp_nBasinsBelow ;

                this.nShe_Bin = (int)inspection.insp_nSheBins ;
                this.she_BinTotRate = (int)inspection.insp_sheBinsTotalRate ;
                this.she_BinLessThan = (int)inspection.insp_nSheBinsBelow ;
            this.bathRoomComment = inspection.insp_commentSection;
        }



        private void Bathroom()
        {
            //Shower
            if (showerGood.IsChecked == true)
            {
                showerTotRate = showerTotRate + 2;
            }
            else if (showerUsable.IsChecked == true)
            {
                showerTotRate = showerTotRate + 1;
            }
            else if (showerUnusable.IsChecked == true)
            {
                showerTotRate = showerTotRate + 0;
                showerLessThan = showerLessThan + 1;
            }
            nShower = nShower + Convert.ToInt32(txtShowers.Text);

            //Toilet
            if (toiletGood.IsChecked == true)
            {
                toiletTotRate = toiletTotRate + 2;
            }
            else if (toiletUsable.IsChecked == true)
            {
                toiletTotRate = toiletTotRate + 1;
            }
            else if (toiletUnusable.IsChecked == true)
            {
                toiletTotRate = toiletTotRate + 0;
                toiletLessThan = toiletLessThan + 1;
            }
            nToilets = nToilets + Convert.ToInt32(txtToilet.Text);

            //Basin
            if (basinGood.IsChecked == true)
            {
                basinTotRate = basinTotRate + 2;
            }
            else if (basinUsable.IsChecked == true)
            {
                basinTotRate = basinTotRate + 1;
            }
            else if (basinUnusable.IsChecked == true)
            {
                basinTotRate = basinTotRate + 0;
                basinLessThan = basinLessThan + 1;
            }
            nBasin = nBasin + Convert.ToInt32(txtBasin.Text);

            //She Bin
            if (she_BinGood.IsChecked == true)
            {
                she_BinTotRate = she_BinTotRate + 2;
            }
            else if (she_BinUsable.IsChecked == true)
            {
                she_BinTotRate = she_BinTotRate + 1;
            }
            else if (she_BinUnusable.IsChecked == true)
            {
                she_BinTotRate = she_BinTotRate + 0;
                she_BinLessThan = she_BinLessThan + 1;
            }
            nShe_Bin = nShe_Bin + Convert.ToInt32(txtshe_Bin.Text);

            if(txtComment.Text != null)
            bathRoomComment = bathRoomComment + "oca/bathroom/" + txtComment.Text+"/";

        }

        //private async void updateData()
        //{
        //    HttpClient client = new HttpClient();
        //    var getInspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id);

        //    var inspection = JsonConvert.DeserializeObject<Inspection>(getInspections);

        //    if(inspection.insp_nShowers != null)
        //    {
        //        this.nShower = (int)inspection.insp_nShowers + this.nShower;
        //        this.showerTotRate = (int)inspection.insp_showersTotalRate + showerTotRate;
        //        this.showerLessThan = (int)inspection.insp_nShowersBelow + showerLessThan;

        //        this.nToilets = (int)inspection.insp_nToilets + nToilets;
        //        this.toiletTotRate= (int)inspection.insp_toiletstotalRate + toiletTotRate;
        //        this.toiletLessThan = (int)inspection.insp_nToiletsBelow + toiletLessThan;

        //        this.nBasin = (int)inspection.insp_nBasins + nBasin;
        //        this.basinTotRate = (int)inspection.insp_basinsTotalRate + basinTotRate;
        //        this.basinLessThan = (int)inspection.insp_nBasinsBelow + basinLessThan;

        //        this.nShe_Bin = (int)inspection.insp_nSheBins + nShe_Bin;
        //        this.she_BinTotRate = (int)inspection.insp_sheBinsTotalRate + she_BinTotRate;
        //        this.she_BinLessThan = (int)inspection.insp_nSheBinsBelow + she_BinLessThan;
        //    }
        //}

        private void saveData(Inspection insp)
        {
            insp.insp_nCntrTops = nBathRoomsInpected;

            insp.insp_nShowers = nShower;
            insp.insp_showersTotalRate = showerTotRate;
            insp.insp_nShowersBelow = showerLessThan;

            insp.insp_nToilets = nToilets;
            insp.insp_toiletstotalRate = toiletTotRate;
            insp.insp_nToiletsBelow = toiletLessThan;

            insp.insp_nBasins = nBasin;
            insp.insp_basinsTotalRate = basinTotRate;
            insp.insp_nBasinsBelow = basinLessThan;

            insp.insp_nSheBins = nShe_Bin;
            insp.insp_sheBinsTotalRate = she_BinTotRate;
            insp.insp_nSheBinsBelow = she_BinLessThan;
            insp.insp_commentSection = bathRoomComment;
        }

        private void Add_BathRoom(object sender, EventArgs e)
        {
            //Showers
            if (showerYes.IsChecked == false && showerNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Shower's availability", "Ok");
                return;
            }
            if (showerYes.IsChecked == true && (showerGood.IsChecked == false && showerUnusable.IsChecked == false && showerUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Shower's condition", "Ok");
                return;
            }
            if (showerYes.IsChecked == true && string.IsNullOrEmpty(txtShowers.Text))
            {
                DisplayAlert("Message", "Provide number of Shower", "Ok");
                return;
            }

            //Toilet
            if (toiletYes.IsChecked == false && toiletNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Toilet's availability", "Ok");
                return;
            }
            if (toiletYes.IsChecked == true && (toiletGood.IsChecked == false && toiletUnusable.IsChecked == false && toiletUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Toilet's condition", "Ok");
                return;
            }
            if (toiletYes.IsChecked == true && string.IsNullOrEmpty(txtToilet.Text))
            {
                DisplayAlert("Message", "Provide number of Toilets", "Ok");
                return;
            }

            //basinYes
            if (basinYes.IsChecked == false && basinNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide Basin's availability", "Ok");
                return;
            }
            if (basinYes.IsChecked == true && (basinGood.IsChecked == false && basinUnusable.IsChecked == false && basinUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide Basin's condition", "Ok");
                return;
            }
            if (basinYes.IsChecked == true && string.IsNullOrEmpty(txtBasin.Text))
            {
                DisplayAlert("Message", "Provide number of Basin", "Ok");
                return;
            }

            //she_BinYes
            if (she_BinYes.IsChecked == false && she_BinNo.IsChecked == false)
            {
                DisplayAlert("Message", "Provide She Bin's availability", "Ok");
                return;
            }
            if (she_BinYes.IsChecked == true && (she_BinGood.IsChecked == false && she_BinUnusable.IsChecked == false && she_BinUsable.IsChecked == false))
            {
                DisplayAlert("Message", "Provide She Bin's condition", "Ok");
                return;
            }
            if (she_BinYes.IsChecked == true && string.IsNullOrEmpty(txtshe_Bin.Text))
            {
                DisplayAlert("Message", "Provide number of She Bin", "Ok");
                return;
            }

            Bathroom();
             DisplayAlert("Message", "Bathroom Successfully Added", "Ok");
            nBathRoomsInpected = nBathRoomsInpected + 1;

            bathRoomNum.Text = "Bathroom Number: " + nBathRoomsInpected.ToString();
            clear();
        }

        private void clear()
        {
            //Shower
            showerYes.IsChecked = false;
            showerNo.IsChecked = false;
            showerGood.IsChecked = false;
            showerUnusable.IsChecked = false;
            showerUsable.IsChecked = false;
            txtShowers.Text = null;

            //Toilet
            toiletYes.IsChecked = false;
            toiletNo.IsChecked = false;
            toiletGood.IsChecked = false;
            toiletUnusable.IsChecked = false;
            toiletUsable.IsChecked = false;
            txtToilet.Text = null;

            //basinYes
            basinYes.IsChecked = false;
            basinNo.IsChecked = false;
            basinGood.IsChecked = false;
            basinUnusable.IsChecked = false;
            basinUsable.IsChecked = false;
            txtBasin.Text = null;

            //she_BinYes
            she_BinYes.IsChecked = false;
            she_BinNo.IsChecked = false;
            she_BinGood.IsChecked = false;
            she_BinUnusable.IsChecked = false;
            she_BinUsable.IsChecked = false;
            txtshe_Bin.Text = null;

            txtComment.Text = null;
        }


        private async void InspectKitchen(object sender, EventArgs e)
        {

            bool result = await DisplayAlert("Warning", "If you leave this page without saving, the data you alreday captured will be lost.\n Do you want to save before leaving?", "Yes", "No");
            if (result)
            {
                Inspection inspection = new Inspection();

                saveData(inspection);

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

                await Navigation.PushAsync((new KitchenInspection(this.user_id, this.ipAddress, this.insp_id)));
            }
            else
            {
                await Navigation.PushAsync((new KitchenInspection(this.user_id, this.ipAddress, this.insp_id)));
            }
        }

        private async void InspectBedroom(object sender, EventArgs e)
        {

            bool result = await DisplayAlert("Warning", "If you leave this page without saving, the data you alreday captured will be lost.\n Do you want to save before leaving?", "Yes", "No");
            if (result)
            {
                Inspection inspection = new Inspection();

                saveData(inspection);

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

        private async void SaveInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            saveData(inspection);

            HttpClient client = new HttpClient();

            string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

            var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
            var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
            {
                Content = stringContent
            };

            HttpResponseMessage response = await client.SendAsync(request);
            string results = await response.Content.ReadAsStringAsync();
            await DisplayAlert("Message", "Inspection saved", "Ok");
        }

        private async void SubmitInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            DateTime date = DateTime.Now;

            if (date != null)
            {
                inspection.insp_ocaDate = date;
            }

            saveData(inspection);

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

        private void showerYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (showerYes.IsChecked)
            {
                showerNo.IsChecked = false;

                showerGood.IsEnabled = true;
                showerUnusable.IsEnabled = true;
                showerUsable.IsEnabled = true;

                txtShowers.IsEnabled = true;
            }
        }

        private void showerNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (showerNo.IsChecked)
            {
                showerYes.IsChecked = false;

                showerGood.IsEnabled = false;
                showerUnusable.IsEnabled = false;
                showerUsable.IsEnabled = false;

                showerGood.IsChecked = false;
                showerUnusable.IsChecked = false;
                showerUsable.IsChecked = false;

                txtShowers.IsEnabled = false;
            }
        }

        private void showerGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (showerGood.IsChecked)
            {
                showerUsable.IsChecked = false;
                showerUnusable.IsChecked = false;
            }
        }

        private void showerUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (showerUsable.IsChecked)
            {
                showerGood.IsChecked = false;
                showerUnusable.IsChecked = false;
            }
        }

        private void showerUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (showerUnusable.IsChecked)
            {
                showerGood.IsChecked = false;
                showerUsable.IsChecked = false;
            }
        }

        private void toiletYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (toiletYes.IsChecked)
            {
                toiletNo.IsChecked = false;

                toiletGood.IsEnabled = true;
                toiletUnusable.IsEnabled = true;
                toiletUsable.IsEnabled = true;

                txtToilet.IsEnabled = true;
            }
        }

        private void toiletNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (toiletNo.IsChecked)
            {
                toiletYes.IsChecked = false;

                toiletGood.IsEnabled = false;
                toiletUnusable.IsEnabled = false;
                toiletUsable.IsEnabled = false;

                toiletGood.IsChecked = false;
                toiletUnusable.IsChecked = false;
                toiletUsable.IsChecked = false;

                txtToilet.IsEnabled = false;
            }
        }

        private void toiletGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (toiletGood.IsChecked)
            {
                toiletUsable.IsChecked = false;
                toiletUnusable.IsChecked = false;
            }
        }

        private void toiletUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (toiletUsable.IsChecked)
            {
                toiletGood.IsChecked = false;
                toiletUnusable.IsChecked = false;
            }
        }

        private void toiletUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (toiletUnusable.IsChecked)
            {
                toiletGood.IsChecked = false;
                toiletUsable.IsChecked = false;
            }
        }

        private void basinYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (basinYes.IsChecked)
            {
                basinNo.IsChecked = false;

                basinGood.IsEnabled = true;
                basinUnusable.IsEnabled = true;
                basinUsable.IsEnabled = true;

                txtBasin.IsEnabled = true;
            }
        }

        private void basinNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (basinNo.IsChecked)
            {
                basinYes.IsChecked = false;

                basinGood.IsEnabled = false;
                basinUnusable.IsEnabled = false;
                basinUsable.IsEnabled = false;

                basinGood.IsChecked = false;
                basinUnusable.IsChecked = false;
                basinUsable.IsChecked = false;

                txtBasin.IsEnabled = false;
            }
        }

        private void basinGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (basinGood.IsChecked)
            {
                basinUsable.IsChecked = false;
                basinUnusable.IsChecked = false;
            }
        }

        private void basinUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (basinUsable.IsChecked)
            {
                basinGood.IsChecked = false;
                basinUnusable.IsChecked = false;
            }
        }

        private void basinUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (basinUnusable.IsChecked)
            {
                basinGood.IsChecked = false;
                basinUsable.IsChecked = false;
            }
        }

        private void she_BinYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (she_BinYes.IsChecked)
            {
                she_BinNo.IsChecked = false;

                she_BinGood.IsEnabled = true;
                she_BinUnusable.IsEnabled = true;
                she_BinUsable.IsEnabled = true;

                txtshe_Bin.IsEnabled = true;
            }
        }

        private void she_BinNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (she_BinNo.IsChecked)
            {
                she_BinYes.IsChecked = false;

                she_BinGood.IsEnabled = false;
                she_BinUnusable.IsEnabled = false;
                she_BinUsable.IsEnabled = false;

                she_BinGood.IsChecked = false;
                she_BinUnusable.IsChecked = false;
                she_BinUsable.IsChecked = false;

                txtshe_Bin.IsEnabled = false;
            }
        }

        private void she_BinGood_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (she_BinGood.IsChecked)
            {
                she_BinUnusable.IsChecked = false;
                she_BinUsable.IsChecked = false;
            }
        }

        private void she_BinUsable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (she_BinUsable.IsChecked)
            {
                she_BinGood.IsChecked = false;
                she_BinUnusable.IsChecked = false;
            }
        }

        private void she_BinUnusable_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (she_BinUnusable.IsChecked)
            {
                she_BinGood.IsChecked = false;
                she_BinUsable.IsChecked = false;
            }
        }
    }
}