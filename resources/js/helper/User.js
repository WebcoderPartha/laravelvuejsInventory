import AppStorage from "./AppStorage";
import Token from "./Token";

class User {

    responseAfterLogin(token, userId){
        const user_id = userId;
        const access_token = token;

        if (Token.isValidate(access_token)){
            AppStorage.storeAuthUser(access_token, user_id)
        }

    }

    hasToken(){
        const getToken = localStorage.getItem('token')
        if (getToken){
            if (Token.isValidate(getToken)){
                return true
            }
        }
    }

    authenticate(){
        return this.hasToken()
    }

    userId(){
        if (this.authenticate()){
            return AppStorage.getUserId()
        }
    }

    logout(){
        if (this.authenticate()){
            AppStorage.clearAuthUser()
        }
    }

}

export default User = new User();