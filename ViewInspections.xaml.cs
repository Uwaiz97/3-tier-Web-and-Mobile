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
    public partial class ViewInspections : ContentPage
    {
        private string ipAddress;
        private int user_id;
        public ViewInspections(int id, string ipAddress)
        {
            InitializeComponent();
            this.ipAddress = ipAddress;
            this.user_id = id;

            FetchData();
        }

        async void FetchData()
        {
            HttpClient client = new HttpClient();
            var response = await client.GetStringAsync("http://"+this.ipAddress+"80/team27-dev/api/index.php/property");
            var properties = JsonConvert.DeserializeObject<List<Property>>(response);
            var filteredProperties = properties.Where(p => p.prop_accreditStatus == "Inspection").ToList();

            listView.ItemsSource = filteredProperties;
        }

        async void OnItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var property = (Property)e.SelectedItem;
            //await Navigation.PushAsync(new AboutProperty(property, this.user_id, this.ipAddress));
        }
    }
}