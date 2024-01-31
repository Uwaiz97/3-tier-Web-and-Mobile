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
    public partial class RegisterToStudentAcc : ContentPage
    {
        private int user_id;
        public RegisterToStudentAcc(int id)
        {
            InitializeComponent();
            this.user_id = id;
        }
    }
}