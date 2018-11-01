import Service from './Service'

class Role extends Service {
  async create (account) {
    return this.post('/role', account)
  }

  async list (page = '1') {
    return this.get(`/role?page=${page}`)
  }

  async listPermissions (roleId) {
    return this.get(`/role/${roleId}/permissions`)
  }

  async assignPermission (roleId, permissionId) {
    return this.put(`/role/${roleId}/assign-permission/${permissionId}`)
  }

  async unassignPermission (roleId, permissionId) {
    return this.put(`/role/${roleId}/unassign-permission/${permissionId}`)
  }
}

export default Role
