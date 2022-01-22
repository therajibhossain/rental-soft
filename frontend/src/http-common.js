import axios from "axios";

const token = "3|tjSI5alcZwVewWA1iMdOkz02K4UMe0KRmDy2uuEn";

export default axios.create({
  baseURL: "http://localhost/api",
  headers: {
    "Content-type": "application/json",
    Authorization: `Bearer ${token}`
  }
});