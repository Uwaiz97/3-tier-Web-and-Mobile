using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;

namespace App2
{
    public class Main
    {
        private string results;
        private User user;
        private string url;
        private List<User> responseData;
        public Main(User user, string url)
        {
            this.user = user;
            this.url = url;
            ApiResponse(this.user, this.url);
            responseData = JsonConvert.DeserializeObject<List<User>>(this.results);
        }

        public string getResults()
        {
            return results;
        }
        public async void ApiResponse(User user, string url)
        {
            HttpClient client = new HttpClient();
            string jsonData = JsonConvert.SerializeObject(user);
            StringContent content = new StringContent(jsonData, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync(url, content);
            string results = await response.Content.ReadAsStringAsync();
            this.results =  results;
        }

        public List<User> getUsers()
        {
            ApiResponse(this.user, this.url);
            return this.responseData;
        }

    }


}
