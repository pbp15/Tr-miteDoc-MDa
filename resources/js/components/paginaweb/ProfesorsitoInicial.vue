<template>

	<!-- <div v-if="arrayProfesore" class="row">
					<div class="blog-entry col-md-4 " v-for="profesore in arrayProfesore" :key="profesore.id" >
							<div style="position: relative">
                			<a href="#"><img  class="img-fluid " :src="'imagepage/profesores'+profesore.imagen" :title="profesore.nombres" />	</a>
                             </div>
                         <div class="text bg-white p-4" >
							<h3 class="heading"><a href="#">{{profesore.nombres}}</a></h3>
							<strong><h4>{{profesore.curso_cargo}}</h4></strong>
							<strong><p>{{profesore.nivel}}</p></strong>
						</div>
					</div>
	</div> -->

  
                        <div v-if="arrayProfesore"  class="staff">
                            <div class="img-wrap d-flex align-items-stretch">
                                <div  class="img align-self-stretch">
                		        	<a href="#"><img  class="img-fluid " :src="'imagepage/profesores/inicial'+profesore.imagen" :title="profesore.nombres" />	</a>
                             </div>
                               
                            </div>
                            <div class="text pt-3 text-center">
                                <h3>{{profesore.nombres}}</h3>
                                <span class="position mb-2">{{profesore.curso_cargo}} </span>
                                <strong><p>{{profesore.nivel}}</p></strong>
                                <div class="faded">
                                    <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                                    <ul class="ftco-social text-center">
                                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                        <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
              

		
</template>

<script>
    export default {
        mounted() {
            this.getProfesore()
        },
        data() {
            return {
                    arrayProfesore:[]
            }
        },
        methods: {
            getProfesore(){
                let me = this;
                var url = '/profesores/inicial';
                axios.get(url).then((Response)=>{
                  //  console.log(Response);
                   
                    me.arrayProfesore=Response.data.profesores;
                }).catch((error)=>{
                    console.log(error)
                })
            }
        },
    }
</script>
