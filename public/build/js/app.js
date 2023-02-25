let paso=1;const cita={nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginado(),paginaSiguiente(),paginaAnterior(),consultaAPI(),agregarNombre(),agregarFecha(),agregarHora()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){botones=document.querySelectorAll(".tabs button"),botones.forEach(e=>{e.addEventListener("click",e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginado()})})}function botonesPaginado(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("oculto"),t.classList.remove("oculto");break;case 2:e.classList.remove("oculto"),t.classList.remove("oculto");break;case 3:t.classList.add("oculto"),e.classList.remove("oculto")}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginado())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginado())})}async function consultaAPI(){try{const e="http://localhost:3020/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=o;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent="$ "+a;const n=document.createElement("DIV");n.classList.add("servicio"),n.dataset.idServicio=t,n.appendChild(c),n.appendChild(r),n.onclick=()=>{agregarCita(e)};document.querySelector("#servicios").appendChild(n)})}function agregarCita(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function agregarNombre(){const e=document.querySelector("#nombre").value;cita.nombre=e}function agregarFecha(){const e=document.querySelector("#fecha"),t=fechaMinima();e.setAttribute("min",t),e.addEventListener("input",e=>{const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no abrimos","error")):cita.fecha=e.target.value})}function mostrarAlerta(e,t){if(document.querySelector(".alerta"))return;const o=document.createElement("P");o.textContent=e,o.classList.add("alerta"),o.classList.add(t);document.querySelector(".formulario").appendChild(o),setTimeout(()=>{o.remove()},3e3)}function fechaMinima(){const e=new Date,t=e.getDate()+1;return`${e.getFullYear()}-${e.toLocaleString("es-NI",{month:"2-digit"})}-${t}`}function agregarHora(){document.querySelector("#hora").addEventListener("input",e=>{const t=e.target.value.split(":")[0];t>18||t<7?(e.target.value="",mostrarAlerta("La hora elegida no esta permitida","error")):(cita.hora=e.target.value,console.log(cita))})}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});