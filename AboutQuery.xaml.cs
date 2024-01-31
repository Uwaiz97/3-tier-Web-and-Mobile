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
    public partial class AboutQuery : ContentPage
    {
        public AboutQuery()
        {
            InitializeComponent();
        }

        public AboutQuery(Query query)
        {
            InitializeComponent();

            BindingContext = query;
        }
    }
}