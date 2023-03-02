let paso=1;const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginado(),paginaSiguiente(),paginaAnterior(),consultaAPI(),agregarNombre(),agregarFecha(),agregarHora(),agregarId()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const a=document.querySelector(".actual");a&&a.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){botones=document.querySelectorAll(".tabs button"),botones.forEach(e=>{e.addEventListener("click",e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginado()})})}function botonesPaginado(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("oculto"),t.classList.remove("oculto");break;case 2:e.classList.remove("oculto"),t.classList.remove("oculto");break;case 3:t.classList.add("oculto"),e.classList.remove("oculto"),mostrarResumen()}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginado())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginado())})}async function consultaAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:a,precio:o}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=a;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent="$ "+o;const c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=t,c.appendChild(n),c.appendChild(r),c.onclick=()=>{agregarCita(e)};document.querySelector("#servicios").appendChild(c)})}function agregarCita(e){const{id:t}=e,{servicios:a}=cita,o=document.querySelector(`[data-id-servicio="${t}"]`);a.some(e=>e.id===t)?(cita.servicios=a.filter(e=>e.id!==t),o.classList.remove("seleccionado")):(cita.servicios=[...a,e],o.classList.add("seleccionado"))}function agregarNombre(){const e=document.querySelector("#nombre").value;cita.nombre=e}function agregarId(){const e=document.querySelector("#id").value;cita.id=e}function agregarFecha(){const e=document.querySelector("#fecha"),t=fechaMinima();e.setAttribute("min",t),e.addEventListener("input",e=>{const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no abrimos","error",".formulario")):cita.fecha=e.target.value})}function mostrarAlerta(e,t,a,o=!0){const n=document.querySelector(".alerta");n&&n.remove();const r=document.createElement("P");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(a).appendChild(r),o&&setTimeout(()=>{r.remove()},3e3)}function fechaMinima(){const e=new Date;return e.setDate(e.getDate()+1),e.toISOString().split("T")[0]}function agregarHora(){document.querySelector("#hora").addEventListener("input",e=>{const t=e.target.value.split(":")[0];t>18||t<7?(e.target.value="",mostrarAlerta("La hora elegida no esta permitida","error",".formulario")):(cita.hora=e.target.value,console.log(cita))})}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0==cita.servicios.length)return void mostrarAlerta("Faltan datos de los servicios, Fecha u hora","error",".contenido-resumen",!1);const{nombre:t,fecha:a,hora:o,servicios:n}=cita,r=document.createElement("P");r.innerHTML="<span>Nombre:</span> "+t;const c=new Date(a+" 00:00").toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),i=document.createElement("P");i.innerHTML="<span>Fecha:</span> "+c;const s=document.createElement("P");s.innerHTML="<span>Hora:</span> "+o;const d=document.createElement("H3");d.textContent="Resumen de Servicios",e.appendChild(d),n.forEach(t=>{const{precio:a,nombre:o}=t,n=document.createElement("DIV");n.classList.add("contenedor-servicio");const r=document.createElement("P");r.innerHTML="<span>Nombre del servicio:</span> "+o;const c=document.createElement("P");c.innerHTML="<span>Precio:</span> $"+a,n.appendChild(r),n.appendChild(c),e.appendChild(n)});const l=document.createElement("H3");l.textContent="Resumen de Cita",e.appendChild(l);const u=document.createElement("BUTTON");u.classList.add("boton"),u.textContent="Reservar cita",u.onclick=reservarCita,e.appendChild(r),e.appendChild(i),e.appendChild(s),e.appendChild(u)}async function reservarCita(){const{nombre:e,fecha:t,hora:a,servicios:o,id:n}=cita,r=o.map(e=>e.id),c=new FormData;c.append("fecha",t),c.append("hora",a),c.append("usuarioId",n),c.append("servicios",r);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:c});(await t.json()).resultado&&Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita fue creada correctamente",closeButton:"Ok"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Ocurrio un error inesperado, trata de recargar la pagina"})}}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});