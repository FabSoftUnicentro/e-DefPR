import Service from './Service'

class AttendmentType extends Service {
  async create (attendmentType) {
    return this.post('/attendmentType', attendmentType)
  }

  async list (page = '1') {
    return this.get(`/attendmentType?page=${page}`)
  }
}

export default AttendmentType
