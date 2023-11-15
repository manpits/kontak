<template>
    <div class="container">
        <h2>Form Kontak</h2>
        <form @submit.prevent="simpan()">
            <div class="mb-3 form-group">
                <label>Nama</label>
                <input type="text" class="form-control" v-model="kontak.nama">
            </div>
            <div class="mb-3 form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" v-model="kontak.alamat">
            </div>
            <div class="mb-3 form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" v-model="kontak.telepon">
            </div>
            <div class="mb-3 form-group">
                <label>Gender</label>
                <select v-model="kontak.gender" class="form-control">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div class="btn-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
            </div>

        </form>

        <h2>Data Kontak</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>Telepon</td>
                    <td>Gender</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(kontak,index) in allKontak" :key="kontak.id">
                    <td>{{ kontak.id }}</td>
                    <td>{{ kontak.nama }}</td>
                    <td>{{ kontak.alamat }}</td>
                    <td>{{ kontak.telepon }}</td>
                    <td>{{ kontak.gender }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" @click="edit(kontak)">Edit</button>
                            <button type="button" class="btn btn-danger" @click="remove(kontak)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'redaxios';

    export default {
        name : 'kontak',
        data(){
            return {
                allKontak : {},
                kontak:{
                    'id':'',
                    'nama':'',
                    'alamat':'',
                    'telepon':'',
                    'gender':''
                }
            }            
        },
        created(){
            console.log('Created !');
            this.loadAllKontak();
        },
        mounted(){
            console.log('Mounted');
        },
        methods:{
            loadAllKontak(){
                var url = `http://127.0.0.1:8000/api/kontak`;
                axios.get(url).then(
                    ({data})=>{
                        console.log(data);
                        this.allKontak = data;
                    }
                );
            },
            remove(kontak){
                var url = `http://127.0.0.1:8000/api/kontak/${kontak.id}`;
                axios.delete(url).then(
                    ()=>{
                        console.log('Berhasil dihapus !');
                        this.loadAllKontak();
                    }
                );
            },
            edit(kontak){
                var url = `http://127.0.0.1:8000/api/kontak/${kontak.id}`;
                axios.get(url).then(
                    ({data})=>{
                        this.kontak = data;
                        console.log(this.kontak);
                    }
                );
            },
            simpan(){
                if(this.kontak.id==''){
                    //simpan baru
                    var url = `http://127.0.0.1:8000/api/kontak`;
                    axios.post(url,this.kontak).then(
                        ()=>{
                            console.log('berhasil di simpan');
                            this.loadAllKontak();
                            this.clear();
                        }
                    );
                }else{
                    var url = `http://127.0.0.1:8000/api/kontak/${this.kontak.id}`;
                    axios.put(url,this.kontak).then(
                        ()=>{
                            console.log('berhasil di edit');
                            this.loadAllKontak();
                            this.clear();
                        }
                    );
                }
            },
            clear(){
                this.kontak.id='';
                this.kontak.nama='';
                this.kontak.alamat='';
                this.kontak.telepon='';
                this.kontak.gender='';
            }
        }
    }

</script>