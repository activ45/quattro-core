
export default class User {
    constructor(data) {
        for (let dat in data) {
            this[dat] = data[dat];
        }
    }
    get full_name(){
        return this.first_name + " "+ this.last_name;
    }
}
