let jwt = require('jsonwebtoken');
const fs = require('fs');
let _ = require('lodash');
let foreach = require('foreach');

export default class Booking {
	constructor(data) {
		this.BookingModel = data
		this.BufferData = []
	}
}
