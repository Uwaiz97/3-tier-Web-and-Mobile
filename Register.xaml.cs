using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class Register : ContentPage
    {
        private string userType;
        private string ipAddress;
        public Register(string ipAddress)
        {
            InitializeComponent();
            this.ipAddress = ipAddress;

        }

        public void UserType(object sender, EventArgs agrs)
        {
            RadioButton userType = sender as RadioButton;
            this.userType = (string)userType.Content;
        }

        public async void Register_Clicked(object sender, EventArgs args)
        {
            activityIndicator.IsRunning = true;

            var isEmail = Regex.IsMatch(txtEmail.Text, "@");
            var isPhone = Regex.IsMatch(txtPhone.Text, "[0-9]");

            try
            {

                if (txtName.Text.Length == 0 || txtSurname.Text.Length == 0 || txtEmail.Text.Length == 0 || txtPhone.Text.Length == 0 || txtPassword.Text == null || txtConfirm.Text == null || this.userType == null)
                {

                    if (txtName.Text.Length == 0)
                    {
                        await DisplayAlert("Missing Data", "First Name can not be empty, Please Enter your First Name.", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (txtSurname.Text.Length == 0)
                    {
                        await DisplayAlert("Missing Data", "Last Name can not be empty, Please Enter your Last Name.", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (txtEmail == null)
                    {
                        await DisplayAlert("Missing Data", "Email can not be empty, Please Enter your Email Address.", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (txtPhone.Text == null)
                    {
                        await DisplayAlert("Missing Data", "Phone Number can not be empty, Please Enter your Phone Number.", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (txtPassword == null)
                    {
                        await DisplayAlert("Missing Data", "Password can not be empty, Please Enter Password of your choice.", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (txtConfirm == null)
                    {
                        await DisplayAlert("Missing Data", "Please Confirm Password", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }

                    if (this.userType == null)
                    {
                        await DisplayAlert("Missing Data", "Please select user type", "OK");
                        activityIndicator.IsRunning = false;
                        return;
                    }
                }
            }
            catch (System.NullReferenceException)
            {
                await DisplayAlert("Missing data", "There is an empty field, please fill in all fields", "OK");
                activityIndicator.IsRunning = false;
                return;
            }


            if (!(isPhone))
            {
                await DisplayAlert("Incorrect Phone Number Format", "Phone number must contaian only numbers", "OK");
                activityIndicator.IsRunning = false;
                return;
            }

            if (!isEmail)
            {
                await DisplayAlert("Message", "Incorrect email format. \nEmail must have @ symbol", "OK");
                activityIndicator.IsRunning = false;
                return;
            }

            //Password not match 
            if (!(txtPassword.Text.Equals(txtConfirm.Text)))
            {
                await DisplayAlert("Password does not match", "", "OK");
                activityIndicator.IsRunning = false;
                return;
            }

            try
            {
                btnRegister.IsEnabled = false;
                User user = new User();
               
                user.user_name = txtName.Text;
                user.user_surname = txtSurname.Text;
                user.user_email = txtEmail.Text;
                user.user_phoneNo = txtPhone.Text;
                user.user_password = txtPassword.Text;
                user.user_type = this.userType;
                user.method = "register";

                string url = "http://" + ipAddress + ":80/team27-dev/api/index.php/user";
                HttpClient client = new HttpClient();
                string jsonData = JsonConvert.SerializeObject(user);
                StringContent content = new StringContent(jsonData, Encoding.UTF8, "application/json");
                HttpResponseMessage response = await client.PostAsync(url, content);
                string results = await response.Content.ReadAsStringAsync();

                User responseData = JsonConvert.DeserializeObject<User>(results);
                
                user.user_id = responseData.user_id;
                   
                if (user.user_id > 0)
                {
                    await DisplayAlert("Successful", "User registered", "OK");
                    btnRegister.IsEnabled = true;
                    Application.Current.MainPage =  new NavigationPage(new LogIn());
                    activityIndicator.IsRunning = false;
                    btnRegister.IsEnabled = true;
                    return;
                }

                await DisplayAlert("Successful", " " + results, "OK");
                activityIndicator.IsRunning = false;
                btnRegister.IsEnabled = true;

            }
            catch(Exception ex)
            {
                await DisplayAlert("Error Message", "Something went wrong please try again later."+ex.Message, "Ok");
                btnRegister.IsEnabled = true;
                activityIndicator.IsRunning = false;
                return;
            }
        }

        public void TapGestureRecognizer_Tapped(object sender, EventArgs args)
        {
            activityIndicator.IsRunning = true;
            Navigation.PushModalAsync(new LogIn());
            activityIndicator.IsRunning = false;

        }
    }
}