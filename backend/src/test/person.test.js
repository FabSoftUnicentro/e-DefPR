const test = require('tape');
const supertest = require('supertest');
const app  = require('../app.js');

test('GET /api/person/', (p) => {
    supertest(app)
        .get('/api/person/')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON GET OK')
            p.end()
        })
})

test('GET /api/person/:id', (p) => {
    supertest(app)
        .get('/api/person/:id')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.expect(res.status === 200, 'PERSON GET ID OK')
            p.end()
        })
})

test('POST /api/person/:id', (p) => {
    supertest(app)
        .get('/api/person/')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON POST OK')
            p.end()
        })
})

test('POST /api/person/:authenticate', (p) => {
    supertest(app)
        .get('/api/person/:authenticate')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON POST AUTHENTICATE OK')
            P.end()
        })
})

test('POST /api/person/refresh-token', (p) => {
    supertest(app)
        .get('/api/person/refresh-token')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON POST REFRESH TOKEN OK')
            p.end()
        })
})

test('PUT /api/person/:id', (p) => {
    supertest(app)
        .get('/api/person/:id')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON PUT OK')
            p.end()
        })
})

test('DELETE /api/person/:id', (p) => {
    supertest(app)
        .get('/api/person/:id')
        .expect('Content-Type', /Json/)
        .expect(200)
        .end((err, res) => {
            p.error(err, 'NO ERRORS')
            p.assert(res.status === 200, 'PERSON DELETE OK')
            p.end()
        })
})