using App2.Landlord;
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
	public partial class AboutProperty : ContentPage
	{
        private int user_id;
        private int insp_id;
        private string ipAddress;
        Property property;
          
        public AboutProperty(Property property, int id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            btnChooseInspection.IsVisible = true;
            this.user_id = id;
            this.property = property;
            this.ipAddress = ipAddress;
            this.insp_id = insp_id;
            BindingContext = property;
        }

        public AboutProperty(Property property, int id, string ipAddress, int insp_id, bool isInspected)
        {
            InitializeComponent();
            btnAccepted.IsVisible = true;
            this.user_id = id;
            this.property = property;
            this.ipAddress = ipAddress;
            this.insp_id = insp_id;
            BindingContext = property;
        }


        private async void AcceptpInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            HttpClient client = new HttpClient();

            //Get Inspector type
            var getStuff = await client.GetAsync("http://"+ ipAddress + ":80/team27-dev/api/index.php/staff/"+this.user_id);
            string getStaffResults = await getStuff.Content.ReadAsStringAsync();
            Stuff inspector = JsonConvert.DeserializeObject<Stuff>(getStaffResults);

            //Get Inspection
            if(inspector.staff_type == "Security")
            {

                var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
                var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);

                foreach (Inspection _inspection in inspections)
                {
                    if(_inspection.sec_Id == this.user_id && _inspection.insp_secDate == null)
                    {
                        await DisplayAlert("Message response", "Inspector have active inspection" , "OK");
                        return;
                    }
                }

                inspection.sec_Id = this.user_id;
                string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

                var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
                var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
                {
                    Content = stringContent
                };

                bool result = await DisplayAlert("Warning", "Are you sure you want to Accept this inspection", "Yes", "No");
                if (result)
                {
                    // Clear all application data
                    Application.Current.Properties.Clear();

                    // Navigate to LoginPage
                    HttpResponseMessage response = await client.SendAsync(request);
                    string results = await response.Content.ReadAsStringAsync();
                    await DisplayAlert("Message response", "Inspection sucessfully accepted", "OK");
                    await Navigation.PushAsync(new ChooseInpection(user_id, ipAddress));
                    return;
                }
                else
                {
                    return;
                }


            }
            else if(inspector.staff_type == "Co-Ordinator")
            {
                var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
                var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);

                foreach (Inspection _inspection in inspections)
                {
                    if (_inspection.oca_Id == this.user_id && _inspection.insp_ocaDate == null)
                    {
                        await DisplayAlert("Message response", "Inspector have active inspection", "OK");
                        return;
                    }
                }
                inspection.oca_Id = this.user_id;
                string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

                var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
                var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
                {
                    Content = stringContent
                };

                bool result = await DisplayAlert("Warning", "Are you sure you want to Accept this inspection", "Yes", "No");
                if (result)
                {
                    // Clear all application data
                    Application.Current.Properties.Clear();

                    // Navigate to LoginPage
                    HttpResponseMessage response = await client.SendAsync(request);
                    string results = await response.Content.ReadAsStringAsync();
                    await DisplayAlert("Message response", "Inspection sucessfully accepted", "OK");
                    await Navigation.PushAsync(new ChooseInpection(user_id, ipAddress));
                    return;
                }
                else
                {
                    return;
                }
            }
            else
            {
                var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
                var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);

                foreach (Inspection _inspection in inspections)
                {
                    if (_inspection.ohs_Id == this.user_id && _inspection.insp_ohsDate == null)
                    {
                        await DisplayAlert("Message response", "Inspector have active inspection", "OK");
                        return;
                    }
                }
                inspection.ohs_Id = this.user_id;
                string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;

                var stringContent = new StringContent(JsonConvert.SerializeObject(inspection), Encoding.UTF8, "application/json");
                var request = new HttpRequestMessage(new HttpMethod("PATCH"), url)
                {
                    Content = stringContent
                };
                bool result = await DisplayAlert("Warning", "Are you sure you want to Accept this inspection", "Yes", "No");
                if (result)
                {
                    // Clear all application data
                    Application.Current.Properties.Clear();

                    // Navigate to LoginPage
                    HttpResponseMessage response = await client.SendAsync(request);
                    string results = await response.Content.ReadAsStringAsync();
                    await DisplayAlert("Message response", "Inspection sucessfully accepted", "OK");
                    await Navigation.PushAsync(new ChooseInpection(user_id, ipAddress));
                    return;
                }
                else
                {
                    return;
                }
            }
        }

        private async void Inspect(object sender, EventArgs e)
        {
            HttpClient client = new HttpClient();

            //Get Inspector type
            var getStuff = await client.GetAsync("http://" + ipAddress + ":80/team27-dev/api/index.php/staff/" + this.user_id);
            string getStaffResults = await getStuff.Content.ReadAsStringAsync();
            Stuff inspector = JsonConvert.DeserializeObject<Stuff>(getStaffResults);

            if(inspector.staff_type == "Security")
            {
                await Navigation.PushAsync(new Security(this.user_id, this.ipAddress, this.insp_id));
            }

            if (inspector.staff_type == "Co-Ordinator")
            {
                await Navigation.PushAsync(new Inpect(this.user_id, this.ipAddress, this.insp_id));
            }

            if (inspector.staff_type == "OHS")
            {
                await Navigation.PushAsync(new Ohs(this.user_id, this.ipAddress, this.insp_id));
            }

        }
    }
}