<template>

	

	<div v-if="arrayEvento" class="row">
					<div class="blog-entry col-md-4 " v-for="evento in arrayEvento" :key="evento.id" >
							<div style="position: relative">
                			<a href="#"><img  class="img-fluid " :src="'imagepage/eventos/'+evento.imagen" :title="evento.titulo" />	</a>
                            <p style="background-color:#000; position:absolute; bottom: 0">{{evento.fecha}}</p>
                            </div>
                            <!-- <div class="meta-date text-center p-2">
								<span class="day">15</span>
								<span class="mos">Junio</span>
								<span class="yr">2019</span>
							</div> -->
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
                var url = '/evento/show';
                axios.get(url).then((Response)=>{
                  //  console.log(Response);
                   
                    me.arrayEvento=Response.data.eventos;
                }).catch((error)=>{
                    console.log(error)
                })
            }
        },
    }
</script>
