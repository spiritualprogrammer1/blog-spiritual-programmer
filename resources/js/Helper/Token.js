class Token {

    isValid(token)
    {
        const payload = this.payload(token);
        if(payload)
        {
            return payload.iss == "http://127.0.0.1:8000/api/auth/login" ? true : false
        }
        return false
    }

    payload(token) {
        const playload = token.split('.')[1]
        return this.decode(playload)
    }

    decode(param)
    {
        if(this.isBase64(param))
        {
            return  JSON.parse(atob(param))
        }

        return false

    }

    isBase64(str)
    {
        try{
            return btoa(atob(str)).replace(/=/g,"") == str
        }
        catch (err) {
            return false
        }

    }

}

export default Token = new Token()