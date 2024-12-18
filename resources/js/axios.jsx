import axios from "axios";

axios.defaults.baseURL = "http://localhost/api"; // Replace with your API base URL
axios.defaults.headers.post["Content-Type"] = "application/json";

export default axios;
