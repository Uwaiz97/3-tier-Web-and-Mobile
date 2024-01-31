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
    public partial class Ohs : ContentPage
    {
        private string ipAddress;
        private int user_id;
        private int insp_id;
        private Inspection inspection = new Inspection();
        public Ohs(int id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            this.insp_id = insp_id;
            this.user_id = id;
            this.ipAddress = ipAddress;


        }

        private void fire_HornYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fire_HornYes.IsChecked == true)
            {
                fire_HornNo.IsChecked = false;
            }
        }

        private void fire_HornNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fire_HornNo.IsChecked == true)
            {
                fire_HornYes.IsChecked = false;
            }
        }

        private void smoke_detectorsYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (smoke_detectorsYes.IsChecked == true)
            {
                smoke_detectorsNo.IsChecked = false;
            }
        }

        private void smoke_detectorsNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (smoke_detectorsNo.IsChecked == true)
            {
                smoke_detectorsYes.IsChecked = false;
            }
        }

        private void extinguisherYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (extinguisherYes.IsChecked == true)
            {
                extinguisherNo.IsChecked = false;
            }
        }

        private void extinguisherNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (extinguisherNo.IsChecked == true)
            {
                extinguisherYes.IsChecked = false;
            }
        }

        private void firstAidBoxYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (firstAidBoxYes.IsChecked == true)
            {
                firstAidBoxNo.IsChecked = false;
            }
        }

        private void firstAidBoxNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (firstAidBoxNo.IsChecked == true)
            {
                firstAidBoxYes.IsChecked = false;
            }
        }

        private void pest_ControlYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (pest_ControlYes.IsChecked == true)
            {
                pest_ControlNo.IsChecked = false;
            }
        }

        private void pest_ControlNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (pest_ControlNo.IsChecked == true)
            {
                pest_ControlYes.IsChecked = false;
            }
        }

        private void emergency_ProceduresYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (emergency_ProceduresYes.IsChecked == true)
            {
                emergency_ProceduresNo.IsChecked = false;
            }
        }

        private void emergency_ProceduresNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (emergency_ProceduresNo.IsChecked == true)
            {
                emergency_ProceduresYes.IsChecked = false;
            }
        }

        private void exit_DoorsYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (exit_DoorsYes.IsChecked == true)
            {
                exit_DoorsNo.IsChecked = false;
            }
        }

        private void exit_DoorsNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (exit_DoorsNo.IsChecked == true)
            {
                exit_DoorsYes.IsChecked = false;
            }
        }

        private void fireBlanketYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fireBlanketYes.IsChecked == true)
            {
                fireBlanketNo.IsChecked = false;
            }

        }

        private void fireBlanketNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fireBlanketNo.IsChecked == true)
            {
                fireBlanketYes.IsChecked = false;
            }
        }

        private void fireequipmentYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fireequipmentYes.IsChecked == true)
            {
                fireequipmentNo.IsChecked = false;
            }
        }

        private void fireequipmentNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fireequipmentNo.IsChecked == true)
            {
                fireequipmentYes.IsChecked = false;
            }
        }

        private void DB_BoardYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (DB_BoardYes.IsChecked == true)
            {
                DB_BoardNo.IsChecked = false;
            }
        }

        private void DB_BoardNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (DB_BoardNo.IsChecked == true)
            {
                DB_BoardYes.IsChecked = false;
            }
        }

        private void exitRoutesNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (exitRoutesNo.IsChecked == true)
            {
                exitRoutesYes.IsChecked = false;
            }
        }

        private void exitRoutesYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (exitRoutesYes.IsChecked == true)
            {
                exitRoutesNo.IsChecked = false;
            }
        }


        private int validate(Inspection inspection)
        {
            //Exit routes
            if (exitRoutesYes.IsChecked == false && exitRoutesNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Exit routes identified with signage availability is required", "OK");
                return 0;
            }
            else
            {
                if (exitRoutesYes.IsChecked == true)
                {
                    inspection.insp_emgyExitRoute = true;
                }else 
                if (exitRoutesNo.IsChecked == true)
                {
                    inspection.insp_emgyExitRoute = false;
                }
            }

            //DB Board signage
            if (DB_BoardYes.IsChecked == false && DB_BoardNo.IsChecked == false)
            {
                DisplayAlert("Message response", "DB Board signage availability is required", "OK");
                return 0;
            }
            else
            {
                if (DB_BoardYes.IsChecked == true)
                {
                    inspection.insp_dbBrdSign = true;
                }
                else if (DB_BoardNo.IsChecked == true)
                {
                    inspection.insp_dbBrdSign = false;
                }
            }

            //fireequipmentNo
            if (fireequipmentNo.IsChecked == false && fireequipmentYes.IsChecked == false)
            {
                DisplayAlert("Message response", "Fire equipment signage availability is required", "OK");
                return 0;
            }
            else
            {
                if (fireequipmentYes.IsChecked == true)
                {
                    inspection.insp_fireEqptSign = true;
                }
                else if (fireequipmentNo.IsChecked == true)
                {
                    inspection.insp_fireEqptSign = false;
                }
            }

            //fireBlanketNo
            if (fireBlanketNo.IsChecked == false && fireBlanketYes.IsChecked == false)
            {
                DisplayAlert("Message response", "Fire blanket(s) availability is required", "OK");
                return 0;
            }
            else
            {
                if (fireBlanketYes.IsChecked == true)
                {
                    inspection.insp_fireBlankets = true;
                }
                else if (fireBlanketNo.IsChecked == true)
                {
                    inspection.insp_fireBlankets = false;
                }
            }

            //exit_DoorsYes
            if (exit_DoorsYes.IsChecked == false && exit_DoorsNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Exit door(s) availability is required", "OK");
                return 0;
            }
            else
            {
                if (exit_DoorsYes.IsChecked == true)
                {
                    inspection.insp_fireBlankets = true;
                }
                else if (exit_DoorsNo.IsChecked == true)
                {
                    inspection.insp_fireBlankets = false;
                }
            }

            //emergency_ProceduresYes
            if (emergency_ProceduresYes.IsChecked == false && emergency_ProceduresNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Emergency Procedures availability is required", "OK");
                return 0;
            }
            else
            {
                if (emergency_ProceduresYes.IsChecked == true)
                {
                    inspection.insp_emgySigns = true;
                }
                else if (emergency_ProceduresNo.IsChecked == true)
                {
                    inspection.insp_emgySigns = false;
                }
            }

            //pest_ControlYes
            if (pest_ControlYes.IsChecked == false && pest_ControlNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Pest Control availability is required", "OK");
                return 0;
            }
            else
            {
                if (pest_ControlYes.IsChecked == true)
                {
                    //inspection. not found
                }
                else if (pest_ControlNo.IsChecked == true)
                {
                    //inspection.not found
                }
            }

            //firstAidBoxYes
            if (firstAidBoxYes.IsChecked == false && firstAidBoxNo.IsChecked == false)
            {
                DisplayAlert("Message response", "First Aid Box availability is required", "OK");
                return 0;
            }
            else
            {
                if (firstAidBoxYes.IsChecked == true)
                {
                    inspection.insp_firstAid = true;
                }
                else if (firstAidBoxNo.IsChecked == true)
                {
                    inspection.insp_firstAid = false;
                }
            }


            //extinguisherYes
            if (extinguisherYes.IsChecked == false && extinguisherNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Fire extinguisher services and date of service availability is required", "OK");
                return 0;
            }
            else
            {
                if (extinguisherYes.IsChecked == true)
                {
                    inspection.insp_extinguishers = true;
                }
                else if (extinguisherNo.IsChecked == true)
                {
                    inspection.insp_extinguishers = false;
                }
            }

            //smoke_detectorsYes
            if (smoke_detectorsYes.IsChecked == false && smoke_detectorsNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Smoke detectors availability is required", "OK");
                return 0;
            }
            else
            {
                if (smoke_detectorsYes.IsChecked == true)
                {
                    inspection.insp_smkDetect = true;
                }
                else if (smoke_detectorsNo.IsChecked == true)
                {
                    inspection.insp_smkDetect = false;
                }
            }


            //fire_HornYes
            if (fire_HornYes.IsChecked == false && fire_HornNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Evacuation alarm/Fire Horn is required", "OK");
                return 0;
            }
            else
            {
                if (fire_HornYes.IsChecked == true)
                {
                    inspection.insp_fireAlarm = true;
                }
                else if (fire_HornNo.IsChecked == true)
                {
                    inspection.insp_fireAlarm = false;
                }
            }
            return 1;
        }

        private async void SubmitInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            DateTime date = DateTime.Now;

            if (date != null)
            {
                inspection.insp_ohsDate = date;
            }

            int val = validate(inspection);

            if (val == 0)
            {
                return;
            }

            HttpClient client = new HttpClient();
            string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;
            var getInspections = await client.GetStringAsync(url);

            Inspection insp = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (insp.insp_ocaDate != null && insp.insp_secDate != null)
            {
                inspection.insp_status = "Inspection Completed";
            }

            if (ohsComment.Text != null)
            {
                inspection.insp_commentSection = insp.insp_commentSection+ "ohs/-/"+ohsComment.Text + "/";
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
    }
}