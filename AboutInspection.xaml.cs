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
    public partial class AboutInspection : ContentPage
    {
        private int user_id;
        private string ipAddress;
        private Property property;
        public AboutInspection(int id, string ipAddress, Property property)
        {
            InitializeComponent();
            this.user_id = id;
            this.property = property;
            this.ipAddress = ipAddress;
            BindingContext = property;
        }

        private async void Inspect(object sender, EventArgs e)
        {
            HttpClient client = new HttpClient();
            var getInspector = await client.GetStringAsync("http://" + ipAddress + ":80/team27-dev/api/index.php/Staff/"+this.user_id);
            Stuff inspector = JsonConvert.DeserializeObject<Stuff>(getInspector);
        }

        private void AcceptInspection(object sender, EventArgs e)
        {
            HttpClient client = new HttpClient();
           
        }
    }
}