using Microsoft.IdentityModel.Clients.ActiveDirectory;
using System;
using System.Linq;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Inspector
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class InspHomePage : FlyoutPage
    {
        private int user_id;
        private string ipAddress;
        public InspHomePage(int id, string address)
        {
            InitializeComponent();
            NavigationPage.SetHasBackButton(this, false);
            this.ipAddress = address;
            this.user_id = id;
        }


        void OnHomeClicked(object sender, EventArgs e)
        {
            // Navigate to Home Page
            Application.Current.MainPage = new InspHomePage(this.user_id, this.ipAddress);
            IsPresented = false;  // close the flyout
        }

        void OnChooseInspectionClicked(object sender, EventArgs e)
        {
            // Navigate to Choose Inspection Page
            Detail = new NavigationPage(new ChooseInpection(this.user_id, this.ipAddress));
            IsPresented = false;  // close the flyout
        }

        void OnInspectClicked(object sender, EventArgs e)
        {

            Detail = new NavigationPage(new AcceptedInpections(this.user_id, this.ipAddress));
            IsPresented = false;  // close the flyout
        }

        private async void OnLogoutClicked(object sender, EventArgs e)
        {
            bool result = await DisplayAlert("Warning", "Are you sure you want to log out?", "Yes", "No");
            if (result)
            {
                // Clear all application data
                Application.Current.Properties.Clear();

                // Navigate to LoginPage
                
                Application.Current.MainPage = new NavigationPage(new LogIn()); ;
            }
            else
            {
                return;
            }
           
        }
    }
}