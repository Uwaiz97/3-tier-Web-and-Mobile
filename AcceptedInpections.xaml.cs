using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Inspector
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class AcceptedInpections : ContentPage
    {
        private int user_id;
        string ipAddress;
        List<Property> properties = new List<Property>();
        public AcceptedInpections(int user_id,string ipAddress)
        {
            InitializeComponent();
            Shell.SetBackButtonBehavior(this, new BackButtonBehavior
            {
                IsEnabled = true,
                Command = new Command(async () =>
                {
                    // Handle the back button press here.
                    await Shell.Current.Navigation.PopAsync();
                }),
            });
            this.user_id = user_id;
            this.ipAddress = ipAddress;
            FetchData();
        }
        async void FetchData()
        {
            HttpClient client = new HttpClient();
            var inspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/");

            var inspection = JsonConvert.DeserializeObject<List<Inspection>>(inspections);
           
            foreach (Inspection inspctn in inspection)
            {
                if(inspctn.sec_Id == user_id && inspctn.insp_status=="Awaiting Inspectors" && inspctn.insp_secDate == null)
                {
                    var response = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/property/" + inspctn.prop_Id);
                    var prop = JsonConvert.DeserializeObject<Property>(response);
                    properties.Add(prop);
                }

                if (inspctn.oca_Id == user_id && inspctn.insp_status == "Awaiting Inspectors" && inspctn.insp_ocaDate==null)
                {
                    var response = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/property/" + inspctn.prop_Id);
                    var prop = JsonConvert.DeserializeObject<Property>(response);
                    properties.Add(prop);
                }

                if ( inspctn.ohs_Id == user_id && inspctn.insp_status == "Awaiting Inspectors" && inspctn.insp_ohsDate==null)
                {
                    var response = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/property/" + inspctn.prop_Id);
                    var prop = JsonConvert.DeserializeObject<Property>(response);
                    properties.Add(prop);
                }
            }
            listView.ItemsSource = properties;
        }
        async void listView_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var pro = (Property)e.SelectedItem;
            HttpClient client = new HttpClient();
            var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
            var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);
            int inspection_Id = 0;

            foreach (Inspection inspection in inspections)
            {

                if (inspection.prop_Id == pro.prop_id)
                {
                    inspection_Id = inspection.insp_id;
                }
            }

            if (inspection_Id != 0)
            {

                await Navigation.PushAsync(new AboutProperty(pro, this.user_id, this.ipAddress, inspection_Id, true));
            }
            else
            {
                await DisplayAlert("Error Message", "Something Went Wrong. \nPlease Try again later", "Ok");
            }
        }
    }
}