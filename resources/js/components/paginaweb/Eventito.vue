<template>
	<div class="col-md-6 col-lg-4 ftco-animate">
					<div class="blog-entry" v-for="evento in arrayEvento" :key="evento.id" >
							<a href="#"><img class="t-pic " :src="'imagepage/eventos/'+evento.imagen" :title="evento.titulo" />
							<div class="meta-date text-center p-2">
								<span class="day">15</span>
								<span class="mos">Junio</span>
								<span class="yr">2019</span>
							</div>
						</a>
						<div class="text bg-white p-4" >
							<h3 class="heading"><a href="#">{{evento.titulo}}</a></h3>
							<p>{{evento.descripcion}}</p>
							<div class="d-flex align-items-center mt-4">
								<p class="mb-0"><a href="#" class="btn btn-primary">Leer mas<span
											class="ion-ios-arrow-round-forward"></span></a></p>
								<p class="ml-auto mb-0">
									<a href="#" class="mr-2">Admin</a>
									<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
								</p>
							</div>
						</div>
					</div>
				</div>


            
</template>

<script>
    export default {
        mounted() {
            this.getEvento()
        },
        data() {
            return {
                    arrayEvento:[]
            }
        },
        methods: {
            getEvento(){
                let me = this;
                var url = '/evento';
                axios.get(url).then((Response)=>{
                    console.log(Response);
                    var respuesta = Response.data;
                    me.arrayTuristas=respuesta.eventos.data
                }).catch((error)=>{
                    console.log(error)
                })
            }
        },
    }
</script>
