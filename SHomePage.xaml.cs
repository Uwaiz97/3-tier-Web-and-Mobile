using App2.Inspector;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Student
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class SHomePage : FlyoutPage
	{
        private int user_id;
        private string ipAddress;
		public SHomePage (int id, string ipAddress)
		{
			InitializeComponent ();
            NavigationPage.SetHasBackButton(this, false);
            this.ipAddress = ipAddress;
            this.user_id = id;
		}

        private void OnHomeClicked(object sender, EventArgs e)
        {
            Detail = new NavigationPage(new SHomePage(this.user_id, this.ipAddress));
        }
        private void OnRegisterClicked(object sender, EventArgs e)
        {
            Detail = new NavigationPage(new RegisterToStudentAcc(this.user_id)); 
        }

        private void OnMaintananceClicked(object sender, EventArgs e)
        {
            Detail = new NavigationPage(new MaintanenceQueries(this.user_id));

        }

        private void OnPOSA_QuerieClicked(object sender, EventArgs e)
        {
            Detail = new NavigationPage(new POSA_Queries(this.user_id));
        }

        private void OnLogoutClicked(object sender, EventArgs e)
        {
            Application.Current.MainPage = new LogIn();
        }

    }
}