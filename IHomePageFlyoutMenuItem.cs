﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace App2.Inspector
{

    public class IHomePageFlyoutMenuItem
    {
        public IHomePageFlyoutMenuItem()
        {
            TargetType = typeof(IHomePageFlyoutMenuItem);
        }
        public int Id { get; set; }
        public string Title { get; set; }

        public Type TargetType { get; set; }
        public string IconSource { get; set; }
    }
}