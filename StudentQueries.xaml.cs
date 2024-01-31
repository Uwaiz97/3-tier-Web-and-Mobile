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
	public partial class StudentQueries : ContentPage
	{
        private int user_id;
        public StudentQueries(int id)
        {
            InitializeComponent();
            this.user_id = id;

            listView.ItemsSource = new List<Query>
            {
                new Query { Title = "Title", Surname = "Surname 1",  RoomNum = "Student Room number", Description="Issue to be resolved"},
                new Query { Title = "Title", Surname = "Surname 2",  RoomNum = "Student Room number", Description="Issue to be resolved"}, 
                
            };
        }

        async void OnItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var person = (Query)e.SelectedItem;
            await Navigation.PushAsync(new AboutQuery(person));
        }
    }
}