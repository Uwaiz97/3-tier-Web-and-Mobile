using System.Collections.ObjectModel;

namespace App2.Inspector
{

    public class MainViewModel
    {
        public ObservableCollection<Property> Properties { get; set; }
        Property _oldProperty;

        public MainViewModel()
        {
        //    Properties = new ObservableCollection<Property>
        //    {
        //        new Property
        //        {
        //            Title = "Bedroom",
        //            IsVisible = false
        //        },

        //        new Property
        //        {
        //            Title = "Kitchen"
        //        },

        //        new Property
        //        {
        //            Title = "Bathroom"
        //        }
        //    };
        }

        public void HideOrShowProperty(Property property)
        {
            //if(_oldProperty == property)
            //{
            //    property.IsVisible = !property.IsVisible;
            //    UpdateProduct(property);
            //}
            //else
            //{
            //    if(_oldProperty != null)
            //    {
            //        _oldProperty.IsVisible = false;
            //        UpdateProduct(_oldProperty);
            //    }

            //    property.IsVisible = true;
            //    UpdateProduct(property);
            //}
            //_oldProperty = property;
        }

        private void UpdateProduct(Property property)
        {
            var index = Properties.IndexOf(property);
            Properties.Remove(property);
            Properties.Insert(index, property);
        }

    }
}
