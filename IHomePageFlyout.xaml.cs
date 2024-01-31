using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace App2.Inspector
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class IHomePageFlyout : ContentPage
    {
        public ListView ListView;

        public IHomePageFlyout()
        {
            InitializeComponent();

            BindingContext = new IHomePageFlyoutViewModel();
            ListView = MenuItemsListView;
        }

        class IHomePageFlyoutViewModel : INotifyPropertyChanged
        {
            public ObservableCollection<IHomePageFlyoutMenuItem> MenuItems { get; set; }
            
            public IHomePageFlyoutViewModel()
            {
                MenuItems = new ObservableCollection<IHomePageFlyoutMenuItem>(new[]
                {
                    new IHomePageFlyoutMenuItem { Id = 1, Title = "Choose Inpection",IconSource="selectInspection.png",TargetType=typeof(ChooseInpection) },
                    new IHomePageFlyoutMenuItem { Id = 2, Title = "Inspect",IconSource="inpection.webp", TargetType=typeof(Inpect) },
                    new IHomePageFlyoutMenuItem { Id = 3, Title = "Log Out",IconSource="logout.webp", TargetType=null }
           
                });
            }
            
            #region INotifyPropertyChanged Implementation
            public event PropertyChangedEventHandler PropertyChanged;
            void OnPropertyChanged([CallerMemberName] string propertyName = "")
            {
                if (PropertyChanged == null)
                    return;

                PropertyChanged.Invoke(this, new PropertyChangedEventArgs(propertyName));
            }
            #endregion
        }
    }
}