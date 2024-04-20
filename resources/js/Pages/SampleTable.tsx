import React, { useEffect, useState } from "react";
import { Resource, columns } from "@/Components/UsersTable/Columns";
import { DataTable } from "@/Components/ui/data-table";

async function getResources(): Promise<Resource[]> {
  const res = await fetch(
    "https://661b3a7265444945d04f2e77.mockapi.io/resources"
  );
  const data = await res.json();
  return data;
}

export default function Page() {
  const [data, setData] = useState<Resource[]>([]);

  useEffect(() => {
    async function fetchData() {
      const resources = await getResources();
      setData(resources);
    }
    fetchData();
  }, []);

  return (
    <section className="py-24">
      <div className="container">
        <h1 className="mb-6 text-3xl font-bold">All Resources</h1>
        {data.length > 0 ? (
          <DataTable columns={columns} data={data} />
        ) : (
          <p>Loading...</p>
        )}
      </div>
    </section>
  );
}
