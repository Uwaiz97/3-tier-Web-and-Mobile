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
	public partial class SendQuery : ContentPage
	{
		private int user_id;
		public SendQuery (int id)
		{
			InitializeComponent ();
			this.user_id = id;
		}

        void submitQuery(object sender, EventArgs e)
        {
			string query = queryDescription.Text;
        }
    }
}