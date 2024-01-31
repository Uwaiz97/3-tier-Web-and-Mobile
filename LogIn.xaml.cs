using App2.Inspector;
using App2.Landlord;
using App2.Student;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class LogIn : ContentPage
    {
        private int userId;
        //private string ipAddress = "192.168.8.221";
        private string ipAddress = "10.254.76.121";


        public LogIn()
        {
            InitializeComponent();
        }

        public async void LogIn_Clicked(object sender, EventArgs args)
        {
            activityIndicator.IsRunning = true;

           try
            {
                btnLogin.IsEnabled = false;
                User user = new User();
                user.user_email = txtEmail.Text;
                user.user_password = txtPassword.Text;
                user.method = "login";

                string url = "http://"+ ipAddress + ":80/team27-dev/api/index.php/user";
                HttpClient client = new HttpClient();
                string jsonData = JsonConvert.SerializeObject(user);
                StringContent content = new StringContent(jsonData, Encoding.UTF8, "application/json");
                HttpResponseMessage response = await client.PostAsync(url, content);
                string results = await response.Content.ReadAsStringAsync();


                User responseData = JsonConvert.DeserializeObject<User>(results);
                
                if (responseData.user_id > 0)
                {
                            //Get Inspector type
                    var getUser = await client.GetAsync("http://"+ ipAddress + ":80/team27-dev/api/index.php/user/" + responseData.user_id);
                    string data = await getUser.Content.ReadAsStringAsync();

                    User loginUser = JsonConvert.DeserializeObject<User>(data);
                    this.userId = loginUser.user_id;
                    if (loginUser.user_type == "Student")
                    {
                        //Redirect to StudentHome page
                        Application.Current.MainPage = new SHomePage(this.userId, this.ipAddress);
                       activityIndicator.IsRunning = false;
                       return;
                    }
                    else if(loginUser.user_type == "Landlord")
                    {
                        //Redirect to Landlord home page
                        Application.Current.MainPage = new LHomePage(this.userId, this.ipAddress);
                        activityIndicator.IsRunning = false;
                        return;
                    }
                    else if(loginUser.user_type == "Staff")
                    {
                        var getStuff = await client.GetAsync("http://"+ ipAddress + ":80/team27-dev/api/index.php/staff/" + responseData.user_id);
                        string respData = await getStuff.Content.ReadAsStringAsync();

                        Stuff stuff = JsonConvert.DeserializeObject<Stuff>(respData);
                        if (stuff.staff_type == "Administrator")
                        {
                            //Administor not allowed
                            await DisplayAlert("Message", "User not allowed", "Ok");
                            activityIndicator.IsRunning = false;
                            return;
                        }
                        else
                        {
                            //Redirect to Inpector Home page
                            Application.Current.MainPage = new NavigationPage(new InspHomePage(this.userId, this.ipAddress));
                            activityIndicator.IsRunning = false;
                            return;
                        }
                    }
                    else
                    {
                        await DisplayAlert("Message", "User not found", "Ok");
                        activityIndicator.IsRunning = false;
                        btnLogin.IsEnabled = true;
                        return;
                    }
                }
                else
                {
                    await DisplayAlert("Message", "Incorrect credentials. You can register for the new account, if don't have existing account.", "OK");
                    activityIndicator.IsRunning = false;
                    btnLogin.IsEnabled = true;
                    return;
                }

            }
            catch (Exception ex)
            {
                await DisplayAlert("Error Message", "Something went wrong. Please try again later or close the app and reopen it. \n"+ ex.Message, "Ok");
                btnLogin.IsEnabled = true;
                activityIndicator.IsRunning = false;
            }

            activityIndicator.IsRunning = false;
        }

        public void TapGestureRecognizer_Tapped(object sender, EventArgs args)
        {
            Application.Current.MainPage = new NavigationPage(new Register(this.ipAddress));
        }
    }
}