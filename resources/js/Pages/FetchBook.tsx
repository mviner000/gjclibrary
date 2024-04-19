import { Suspense } from "react";
import { Spinner } from "@/Components/Spinner";
import BookTableData from "@/Components/BookTableData";
  
export default function Home() {
    return (
    <div className="w-screen py-20 flex justify-center flex-col items-center">
      <div className="flex items-center justify-between gap-1 mb-5">
        <h1 className="text-4xl font-bold">(Create Read Update and Delete)| Shadcn UI</h1>
      </div>    
        <div className="overflow-x-auto">
          <div className="mb-2 w-full text-right">
          </div>
          <Suspense fallback={<Spinner />}>
            <BookTableData/>
          </Suspense>
      </div>  
    </div>
  ); 
}