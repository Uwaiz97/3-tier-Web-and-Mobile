using App2.Inspector;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Landlord
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class LHomePage : FlyoutPage
	{
        private int user_id;
        private string ipAddress;
		public LHomePage(int id, string ipAddress)
		{
			InitializeComponent ();
            NavigationPage.SetHasBackButton(this, false);
            this.ipAddress = ipAddress;
            this.user_id = id;
		}

        private void OnHomeClicked(object sender, EventArgs e)
        {
            // Navigate to Home Page
            Detail = new NavigationPage(new LHomePage(this.user_id, this.ipAddress));
            IsPresented = false;  // close the flyout
        }

        private void OnAcceptStudentClicked(object sender, EventArgs e)
        {
            // Navigate to Home Page
            Detail = new NavigationPage(new AcceptStudent(this.user_id));
            IsPresented = false;  // close the flyout
        }

        private void OnViewStudentQueriesClicked(object sender, EventArgs e)
        {            // Navigate to Home Page
            Detail = new NavigationPage(new StudentQueries(this.user_id));
            IsPresented = false;  // close the flyout
        }

        private void OnReportToPOSAClicked(object sender, EventArgs e)
        {
            // Navigate to Home Page
            Detail = new NavigationPage(new SendQuery(this.user_id));
            IsPresented = false;  // close the flyout
        }

        private void OnLogoutClicked(object sender, EventArgs e)
        {
            Application.Current.MainPage = new LogIn();
        }
    }
}