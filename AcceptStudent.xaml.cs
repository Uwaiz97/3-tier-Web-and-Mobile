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
    public partial class AcceptStudent : ContentPage
    {
        private int user_id;
        public AcceptStudent(int id)
        {
            InitializeComponent();
            this.user_id = id;
        }
    }
}