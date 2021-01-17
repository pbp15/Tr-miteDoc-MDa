<template>

	<div v-if="arrayTestimonio" class="row">
					<div class="blog-entry col-md-4 " v-for="testimonio in arrayTestimonio" :key="testimonio.id"  >
							<div style="position: relative">
                			  <a href="#"><img  class="img-fluid " :src="'imagepage/testimonios/'+testimonio.imagen" :title="testimonio.nombre" />	</a>
                                 </div>              
						<div class="text bg-white p-4" >
							<h3 class="heading"><a href="#">{{testimonio.descripcion}}</a></h3>
							<p>{{testimonio.nombre}}</p>
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
