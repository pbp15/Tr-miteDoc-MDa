<template>

<div v-if="arrayTestimonio" class="item">
							<div class="testimony-wrap d-flex" v-for="testimonio in arrayTestimonio" :key="testimonio.id"  >
								<div class="user-img mr-4">
								<a href="#"><img  class="img-fluid " :src="'imagepage/testimonios/'+testimonio.imagen" :title="testimonio.nombre" />	</a>
                                </div>
								<div class="text ml-2">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
									<p>{{testimonio.descripcion}}</p>
									<p class="name">{{testimonio.nombre}}</p>
									<span class="position">Madre de Familia</span>
								</div>
							</div>
	</div>

</template>

<script>
    export default {
        mounted() {
            this.getTestimonio()
        },
        data() {
            return {
                    arrayTestimonio:[]
            }
        },
        methods: {
            getTestimonio(){
                let me = this;
                var url = '/testimonio/show';
                axios.get(url).then((Response)=>{
                    console.log(Response);                   
                    me.arrayTestimonio=Response.data.testimonios;
                }).catch((error)=>{
                    console.log(error)
                })
            }
        },
    }
</script>
