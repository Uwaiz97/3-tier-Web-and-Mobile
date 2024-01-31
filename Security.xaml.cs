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
    public partial class Security : ContentPage
    {
        private int user_id;
        private string ipAddress;
        private int insp_id;

        public Security(int id, string ipAddress, int insp_id)
        {
            InitializeComponent();
            this.user_id = id;
            this.insp_id = insp_id;
            this.ipAddress = ipAddress;
        }


        private int validateSecurity(Inspection inspection)
        {
            //Fense
            if (fenseYes.IsChecked == false && fenseNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Fense availability is required", "OK");
                return 0;
            }
            else
            {
                if (fenseYes.IsChecked == true)
                {
                    inspection.insp_fence = true;
                }
                if (fenseNo.IsChecked == true)
                {
                    inspection.insp_fence = false;
                }
            }

            //Gates
            if (gateYes.IsChecked == false && gateNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Gate(s) availability is required", "OK");
                return 0;
            }
            else
            {
                if (gateYes.IsChecked == true)
                {
                    inspection.insp_gates = true;
                }
                if (gateNo.IsChecked == true)
                {
                    inspection.insp_gates = false;
                }
            }


            //Burgler doors
            if (BurglarYes.IsChecked == false && BurglarNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Burglar doors/bars availability is required", "OK");
                return 0;
            }
            else
            {
                if (BurglarYes.IsChecked == true)
                {
                    inspection.insp_burglarProof = true;
                }
                if (BurglarNo.IsChecked == true)
                {
                    inspection.insp_burglarProof = false;
                }
            }

            //CCTV
            if (cctvYes.IsChecked == false && cctvNo.IsChecked == false)
            {
                DisplayAlert("Message response", "CCTV availability is required", "OK");
                return 0;
            }
            else
            {
                if (cctvYes.IsChecked == true)
                {
                    inspection.insp_cctv = true;
                }
                if (cctvNo.IsChecked == true)
                {
                    inspection.insp_cctv = false;
                }
            }

            //Amred Response
            if (armedResYes.IsChecked == false && armedResNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Amred Response availability is required", "OK");
                return 0;
            }
            else
            {
                if (armedResYes.IsChecked == true)
                {
                    inspection.insp_armedResp = true;
                }
                if (armedResNo.IsChecked == true)
                {
                    inspection.insp_armedResp = false;
                }
            }

            //Panic Button
            if (panicButtonYes.IsChecked == false && panicButtonNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Panic Button availability is required", "OK");
                return 0;
            }
            else
            {
                if (panicButtonYes.IsChecked == true)
                {
                    inspection.insp_panicBTN = true;
                }
                if (panicButtonNo.IsChecked == true)
                {
                    inspection.insp_panicBTN = false;
                }
            }

            //Room locks
            if (roomLockYes.IsChecked == false && roomLockNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Room Locks availability is required", "OK");
                return 0;
            }
            else
            {
                if (roomLockYes.IsChecked == true)
                {
                    inspection.insp_roomLocks = true;
                }
                if (roomLockNo.IsChecked == true)
                {
                    inspection.insp_roomLocks = false;
                }
            }


            //Security Officer Posted
            if (secOfficerYes.IsChecked == false && secOfficerNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Room Locks availability is required", "OK");
                return 0;
            }
            else
            {
                if (secOfficerYes.IsChecked == true)
                {
                    inspection.insp_security = true;
                }
                if (secOfficerNo.IsChecked == true)
                {
                    inspection.insp_security = false;
                }
            }

            //Security Officer Posted
            if (lightingYes.IsChecked == false && lightingNo.IsChecked == false)
            {
                DisplayAlert("Message response", "Visible Lighting availability is required", "OK");
                return 0;
            }
            else
            {
                if (lightingYes.IsChecked == true)
                {
                    inspection.insp_lighting = true;
                }
                if (lightingNo.IsChecked == true)
                {
                    inspection.insp_lighting = false;
                }
            }

            if (ConfirmInspectionCB.IsChecked == false)
            {
                DisplayAlert("Message response", "Confirm nspection submition", "OK");
                return 0;
            }

            return 1;
        }

        private void fenseYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fenseNo.IsChecked == true)
            {
                fenseNo.IsChecked = false;
            }
        }

        private void fenseNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (fenseYes.IsChecked == true)
            {
                fenseYes.IsChecked = false;
            }
        }

        private void gateYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (gateNo.IsChecked == true)
            {
                gateNo.IsChecked = false;
            }
        }

        private void gateNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (gateYes.IsChecked == true)
            {
                gateYes.IsChecked = false;
            }
        }

        private void BurglarYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(BurglarNo.IsChecked == true)
            {
                BurglarNo.IsChecked = false;
            }
        }

        private void BurglarNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (BurglarYes.IsChecked == true)
            {
                BurglarYes.IsChecked = false;
            }
        }

        private void cctvYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(cctvNo.IsChecked == true)
            {
                cctvNo.IsChecked = false;
            }
        }

        private void cctvNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (cctvYes.IsChecked == true)
            {
                cctvYes.IsChecked = false;
            }
        }

        private void armedResYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(armedResNo.IsChecked == true)
            {
                armedResNo.IsChecked = false;
            }
        }

        private void armedResNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (armedResYes.IsChecked == true)
            {
                armedResYes.IsChecked = false;
            }
        }

        private void panicButtonYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(panicButtonNo.IsChecked == true)
            {
                panicButtonNo.IsChecked = false;
            }
        }

        private void panicButtonNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (panicButtonYes.IsChecked == true)
            {
                panicButtonYes.IsChecked = false;
            }
        }

        private void roomLockYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(roomLockNo.IsChecked == true)
            {
                roomLockNo.IsChecked = false;
            }
        }

        private void roomLockNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (roomLockYes.IsChecked == true)
            {
                roomLockYes.IsChecked = false;
            }
        }

        private void secOfficerYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(secOfficerNo.IsChecked == true)
            {
                secOfficerNo.IsChecked = false;
            }
        }

        private void secOfficerNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (secOfficerYes.IsChecked == true)
            {
                secOfficerYes.IsChecked = false;
            }
        }

        private void lightingYes_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if(lightingNo.IsChecked == true)
            {
                lightingNo.IsChecked = false;
            }
        }

        private void lightingNo_CheckedChanged(object sender, CheckedChangedEventArgs e)
        {
            if (lightingYes.IsChecked == true)
            {
                lightingYes.IsChecked = false;
            }
        }

        private async void SubmitInspection(object sender, EventArgs e)
        {
            Inspection inspection = new Inspection();
            DateTime dt = DateTime.Now;
            
            if(dt != null)
            {
                inspection.insp_secDate = dt;
            }

            HttpClient client = new HttpClient();
            string url = "http://" + this.ipAddress + ":80/team27-dev/api/index.php/inspection/" + this.insp_id;
            var getInspections = await client.GetStringAsync(url);

            Inspection insp = JsonConvert.DeserializeObject<Inspection>(getInspections);

            if (insp.insp_ocaDate != null && insp.insp_ohsDate != null)
            {
                inspection.insp_status = "Inspection Completed";
            }

            int validate = validateSecurity(inspection);
            if (validate == 0)
            {
                return;
            }

            if(secComment.Text != null)
            {
                inspection.insp_commentSection = insp.insp_commentSection+"sec/-/"+secComment.Text+"/";
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