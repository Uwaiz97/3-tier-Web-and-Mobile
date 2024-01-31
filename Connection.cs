using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;

namespace App2
{
    public class Connection
    {
        private string results;

        public Connection()
        {
            
        }

        public string connect(Object user, string url)
        {
            connection(user, url);
            return this.results;
        }

        private async void connection(Object user, string url)
        {
            HttpClient client = new HttpClient();
            string jsonData = JsonConvert.SerializeObject(user);
            StringContent content = new StringContent(jsonData, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync(url, content);
            this.results = response.Content.ReadAsStringAsync().ToString();
        }
    }
}
