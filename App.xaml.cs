using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using App2.Inspector;
using App2.Landlord;
using App2.Student;

namespace App2
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();

            MainPage = new NavigationPage(new LogIn());
        }

        protected override void OnStart()
        {
        }

        protected override void OnSleep()
        {
        }

        protected override void OnResume()
        {

        }
    }
}
