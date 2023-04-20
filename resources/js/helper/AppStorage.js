class AppStorage {

    storeToken(token){
        sessionStorage.setItem('token', token);
    }

    storeUserId(userid){
        sessionStorage.setItem('userid', userid);
    }

    storeAuthUser(token, userid){
        this.storeToken(token);
        this.storeUserId(userid);
    }

    clearAuthUser(){
        sessionStorage.removeItem('token');
        sessionStorage.removeItem('userid');
    }

    getToken(){
        sessionStorage.getItem('token');
    }
    getUserId(){
        sessionStorage.getItem('userid');
    }

    Authenticate(){
        if (sessionStorage.getItem('token') !== null && sessionStorage.getItem('userid') !== null){
            return true;
        }
    }

}

export default  AppStorage = new AppStorage();