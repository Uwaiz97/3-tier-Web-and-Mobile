using App2.Landlord;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Inspector
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class ChooseInpection : ContentPage
	{
        private int user_id;
        private string ipAddress;
        private int inps_id;
        private List<Property> properties = new List<Property>();
        public ChooseInpection (int id, string ipAddress)
		{
            InitializeComponent ();
            this.user_id = id;
            this.ipAddress = ipAddress;
            FetchData();
            NavigationPage.SetHasBackButton(this, false);
        }

        async void FetchData()
        {
            HttpClient client = new HttpClient();
            var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
            var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);
    
            foreach (Inspection inspection in inspections)
            {
                var response = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/property/" + inspection.prop_Id);
                var prop = JsonConvert.DeserializeObject<Property>(response);

                //To get all users(Staff) replace  this.user_id with 0
                //Use foreach loop and compare the the IDs from the Staff table and the user_id
                //if the IDs match then execute the if statements...
                var staff = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/staff/" + this.user_id);
                var staffType = JsonConvert.DeserializeObject<Stuff>(staff);

                //await DisplayAlert("Message1", "Property: "+ response, "Ok");
                if (staffType.staff_type == "Security" && inspection.insp_status == "Awaiting Inspectors" && inspection.sec_Id == null){
                    if (prop != null)
                        properties.Add(prop);
                }
                else if(staffType.staff_type == "Co-Ordinator" && inspection.insp_status == "Awaiting Inspectors" && inspection.oca_Id == null)
                    {
                    if (prop != null)
                        properties.Add(prop);
                }
                else if (staffType.staff_type == "OHS" && inspection.insp_status == "Awaiting Inspectors" && inspection.ohs_Id == null)
                {
                    if (prop != null)
                        properties.Add(prop);
                }
            }

            if(properties != null)
                listView.ItemsSource = properties;
        }

        async void OnItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var pro = (Property)e.SelectedItem;
            HttpClient client = new HttpClient();
            var getinspections = await client.GetStringAsync("http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection");
            var inspections = JsonConvert.DeserializeObject<List<Inspection>>(getinspections);
            int inspection_Id = 0;

            foreach(Inspection inspection in inspections)
            {
                
                if(inspection.prop_Id == pro.prop_id)
                {
                    inspection_Id = inspection.insp_id;
                }
            }

            if (inspection_Id != 0)
            {
                
                await Navigation.PushAsync(new AboutProperty(pro, this.user_id, this.ipAddress, inspection_Id));
            }
            else
            {
                await DisplayAlert("Error Message", "Something Went Wrong. \nPlease Try again later", "Ok");
            }
               
        }

    }
}

