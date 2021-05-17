<template>
    <div class="container">
        <div class="box">
            <div class="outter-column">
                <div class="row-flex">
                    <div class="column">                        
                        <h2>Invoice</h2>                        
                        <div class="inner-column">
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Your Company*" class="input-text-required-big" v-model="company_name" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Your First and Last Name*" class="input-text-required" v-model="full_name" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Company Website*" class="input-text-required" v-model="company_website" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Company Address" class="input-text-not-required" v-model="company_address" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="City, State ZIP" class="input-text-not-required" v-model="company_csz" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Country" class="input-text-not-required" v-model="company_country" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Phone No.*" class="input-text-required" v-model="company_phone" value="">
                            </div>
                            <div class="form-div">
                                <input type="email" width="100%" placeholder="Email Address*" class="input-text-required" v-model="company_email" value="">
                            </div>
                        </div>
                        <div class="inner-column">
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Client's Company" class="input-text-not-required-big" v-model="client_company" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Client's Name" class="input-text-not-required" v-model="client_name" value="">
                            </div>                            
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Client's Address" class="input-text-not-required" v-model="client_address" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="City, State ZIP" class="input-text-not-required" v-model="client_csz" value="">
                            </div>
                            <div class="form-div">
                                <input type="text" width="100%" placeholder="Country" class="input-text-not-required" v-model="client_country" value="">
                            </div>
                        </div>
                    </div>
                    <div class="column-right">
                        
                        <div class="drop"
                            :class="getClasses" 
                            @dragover.prevent="dragOver" 
                            @dragleave.prevent="dragLeave"
                            @drop.prevent="drop($event)"
                        >   
                            <img class="img" :src="imageSource" v-if="imageSource" />                             
                            <span class="span-text" v-if="!imageSource">Drag & drop a logo file</span>
                        </div>                            
                        
                        <div class="div-right">
                            <div class="flex-end-100">
                                <input type="text" width="30%" class="invoice-input" value="Invoice No:">
                                <input type="text" width="30%" class="invoice-input-val" placeholder="####" v-model="invoice_number" value="">
                            </div>
                            <div class="flex-end">
                                <input type="text" value="Invoice Date:" class="invoice-dates">
                                 <div>
                                    <b-form-datepicker 
                                        id="example-datepicker" 
                                        :date-format-options="{ year: 'numeric', month: 'numeric', day: '2-digit' }"
                                        locale="en"
                                        placeholder="##/##/####"
                                        size="sm" v-model="value" class="mb-2"></b-form-datepicker>
                                </div>
                            </div>
                            <div class="flex-end">
                                <input type="text" value="Due Date:" class="invoice-dates">
                                <div>
                                    <b-form-datepicker 
                                        id="example-datepicker2" 
                                        :date-format-options="{ year: 'numeric', month: 'numeric', day: '2-digit' }"
                                        locale="en"
                                        placeholder="##/##/####"
                                        size="sm" v-model="value2" class="mb-2"></b-form-datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-flex-column">
                    <table class="table-main">
                        <thead>
                            <tr>
                                <th colspan="1" class="ls">
                                    <div class="form-div">
                                        <input type="text" width="100%" placeholder="ID" color="#ffffff" class="ils" value="ID">
                                    </div>
                                </th>
                                <th colspan="2" class="ls">
                                    <div class="form-div">
                                        <input type="text" width="100%" placeholder="Description" color="#ffffff" class="ils" value="Description">
                                    </div>
                                </th>
                                <th colspan="1" class="cs">
                                    <div class="form-div">
                                        <input type="text" width="100%" placeholder="Quantity" color="#ffffff" class="ics" value="Quantity">
                                    </div>
                                </th>
                                <th colspan="1" class="cs">
                                    <div class="form-div">
                                        <input type="text" width="100%" placeholder="Price" color="#ffffff" class="ics" value="Price">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in rowData">
                                <td>
                                    <div class="td-start">
                                        <input type="text" class="td-input" width="100%" v-model="item.invoice_internal_id" :placeholder="index + 1">
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="td-start">
                                        <input type="text" class="td-input" width="100%" v-model="item.description" placeholder="Item description">
                                    </div>
                                </td>
                                <td>
                                    <div class="td-rel">
                                        <input type="text" class="td-input-2" v-model="item.quantity" placeholder="0">
                                    </div>
                                </td>
                                <td>
                                    <div class="td-rel">
                                        <input type="text" class="td-input-2" v-model="item.price" placeholder="$0.00">
                                    </div>
                                    <!-- <span class="sc-gzOgki iRfOzM delete">
                                        <img crossorigin="anonymous" src="//cdn2.hubspot.net/hub/53/file-1134457772.svg" alt="delete">
                                    </span> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="addMore" @click="addItem()">
                        <span>+ Add More</span>
                    </div>
                </div>
                <div class="bottom-f">
                    <div class="column">
                        <div class="f-notes">
                            <span class="snotes">Notes:</span>
                            <textarea class="ta" placeholder="Any additional comments" v-model="notes"></textarea>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="inner-right">
                            <div class="ftotal">
                                <div class="finnertotal">
                                    <input type="text" width="100%" placeholder="Subtotal:" class="iend" value="Subtotal:">
                                </div>
                                <span class="span-r">0.00</span>
                            </div>
                            <div class="ftotal">
                                <div class="finnertotal">
                                    <input type="text" width="100%" placeholder="Tax:" class="iend" value="Tax:">
                                </div>
                                <div class="frel">
                                    <input type="text" min="0" step="0.01" placeholder="0" class="istep" value="15">
                                    <span order="%" class="span-abs">%</span>
                                </div>
                            </div>
                            <div class="ftotal">
                                <div class="finnertotal">
                                    <input type="text" width="100%" placeholder="Discount:" class="iend" value="Discount:">
                                </div>
                                <div class="frel">
                                    <input type="text" min="0" step="0.01" placeholder="0" class="istep" value="">
                                    <span order="%" class="span-abs">%</span>
                                </div>
                            </div>
                            <div color="#eb144c" class="line"></div>
                            <div class="ftotal">
                                <div class="finnertotal">
                                    <input type="text" width="100%" placeholder="Total:" class="iend" value="Total:">
                                </div>
                                <span class="span-r">0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn-orange btn-small btn-bottom" @click="submit()">Submit</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        },

        data() {
            return {
                company_name: '',
                full_name: '',
                company_website: '',
                company_address: '',
                company_csz: '',
                company_country: '',
                company_phone: '',
                company_email: '',
                client_company: '',
                client_name: '',
                client_address: '',
                client_csz: '',
                client_country: '',
                invoice_number: '',
                value: '',
                value2: '',
                isDragging: false,
                wrongFile: false,
                imageSource: null,
                subtotal: 0,
                tax: 0,
                discount: 0,
                total: 0,
                notes: '',
                file: null,
                rowData: [],
                //items: [],
            }
        },

        computed:{
            getClasses(){
              return {isDragging: this.isDragging}
            }
        },

        methods: {
           dragOver(){
              this.isDragging = true
            },

            dragLeave(){
              this.isDragging = false
            },

            drop(e){
                let files = e.dataTransfer.files
                this.wrongFile = false
                // allows only 1 file
                if (files.length === 1) {
                    let file = files[0]
                    // allows image only
                    if (file.type.indexOf('image/') >= 0) {
                        var reader = new FileReader()
                        this.file = file;
                        reader.onload = f => {
                            this.imageSource = f.target.result;
                            this.file = file;
                            this.imageCheck = true;
                            this.isDragging = false;
                        }
                        reader.readAsDataURL(file)
                    } else {
                        this.wrongFile = true
                        this.imageSource = null
                        this.isDragging = false
                    }
                }
            },

            addItem() {                
                var myObject = {
                    'invoice_internal_id': '',
                    'description': '',
                    'quantity': '',
                    'price': ''
                };
                this.rowData.push(myObject);
            },

            submit() {                
                let formData = new FormData();

                formData.append('company_name', this.company_name);
                formData.append('full_name', this.full_name);
                formData.append('company_website', this.company_website);
                formData.append('company_address', this.company_address);
                formData.append('company_city_state_zip', this.company_csz);
                formData.append('country', this.company_country);
                formData.append('company_phone', this.company_phone);
                formData.append('company_email', this.company_email);
                formData.append('client_company_name', this.client_company);
                formData.append('client_full_name', this.client_name);
                formData.append('client_address', this.client_address);
                formData.append('client_city_state_zip', this.client_csz);
                formData.append('client_country', this.client_country);
                formData.append('invoice_number', this.invoice_number);
                formData.append('invoice_date', this.value);
                formData.append('invoice_due_date', this.value2);
                formData.append('logo', this.file);
                formData.append('subtotal', this.subtotal);
                formData.append('tax', this.tax);
                formData.append('discount', this.discount);
                formData.append('total', this.total);
                formData.append('notes', this.notes);
                formData.append('items', this.rowData);
                
                axios.post(`invoices/create`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    console.log(response.data);
                }).catch(e => {

                })
            },
        },
    }
</script>
