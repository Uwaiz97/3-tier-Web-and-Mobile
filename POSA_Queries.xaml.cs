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
	public partial class POSA_Queries : ContentPage
	{
		private int user_id;
		public POSA_Queries (int id)
		{
			InitializeComponent ();
			this.user_id = id;
		}
	}
}