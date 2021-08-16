import config from "../config";

const URL_API = config.url.URL_API;

function buildURL(api, resource = "") {
  return URL_API + resource;
}
const AuthToken = 'Bearer ' + localStorage.getItem('token');

const axios = require("axios");
export const requestsMixin = {
  methods: {
    getCalendar() {
      return axios.get(buildURL("URL_API", "calendar"),{ 
        "Authorization": AuthToken,
        "Access-Control-Allow-Origin": "*",
      });
    },
    addCalendar(data) {
      return axios.post(buildURL("URL_API", "calendar"), data,{ 
        "Authorization": AuthToken,
        "Access-Control-Allow-Origin": "*",
      });
    },
    editCalendar(data) {
      return axios.put(buildURL("URL_API", "calendar/"+data.id), data,{ 
        "Authorization": AuthToken,
        "Access-Control-Allow-Origin": "*",
      });
    },
    deleteCalendar(id) {
      return axios.delete(buildURL("URL_API", "calendar/"+id),{ 
        "Authorization": AuthToken,
        "Access-Control-Allow-Origin": "*",
      });
    }
  }
};
