import React, { useState, useEffect } from 'react';
import DataTable, { TableColumn } from 'react-data-table-component';
import axios from 'axios';
import CreateUser from '@/Components/CreateUser';

import { useToast } from "@/Components/ui/use-toast";
import { ToastAction } from "@/Components/ui/toast";

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/Components/ui/dialog";
import { Copy, Trash2 } from "lucide-react";

interface User {
  id: number;
  name?: string;
  created_at?: string; 
  email?: string;
}

export default function Home() {
  const [users, setUsers] = useState<User[]>([]);
  const [data, setData] = useState([]);
  const { toast } = useToast();
  const [loading, setLoading] = useState(true);
  const [confirmName, setConfirmName] = useState<string>(""); // State for confirming user's name
  const isDeleteButtonDisabled = (user: User) => {
    return confirmName !== user.name;
  };
  

  const columns: TableColumn<any>[] = [
    {
      name: 'ID',
      selector: (row: any) => row.id,
      sortable: true,
    },
    {
      name: 'Name',
      selector: (row: any) => row.name,
      sortable: true,
    },
    {
      name: 'Created_at',
      selector: (row: any) => row.created_at,
      sortable: true,
    },
    {
      name: 'Email',
      selector: (row: any) => row.email,
      sortable: true,
    },
    {
      name: 'Actions',
      cell: (row: any) => <Dialog>
      <DialogTrigger className="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-3 py-1.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2"><Trash2 className="text-red-500 h-4 w-4" /></DialogTrigger>
      <DialogContent>
          <DialogHeader>
              <DialogTitle>Are you absolutely sure?</DialogTitle>
              <DialogDescription>
                  <span>Please enter "{row.name}" to continue</span>
                  <input
                      className="mt-1 mr-2 rounded-md"
                      value={confirmName}
                      onChange={(e) => setConfirmName(e.target.value)}
                  />
                  <button 
                      onClick={() => {
                              toast({
                                variant: "destroy",
                                title: "",
                                description: (<p><span className="font-bold">{row.email}</span> has been successfully deleted</p>),
                                action: <ToastAction altText="Close">Close</ToastAction>,
                              });
                              handleDelete(row.id);
                              }}
                        className={`bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ${isDeleteButtonDisabled(row) ? 'cursor-not-allowed opacity-50 disabled' : ''}`}
                        disabled={isDeleteButtonDisabled(row)} >
                      Delete
                    </button>
              </DialogDescription>
          </DialogHeader>
      </DialogContent>
  </Dialog>,
      ignoreRowClick: true,
      allowOverflow: true,
      button: true,
    },
  ];

  const handleSort = async (column: TableColumn<any>, sortDirection: string) => {
    setLoading(true);
    try {
      const response = await axios.get(`/api/users?sort=${column.selector}&order=${sortDirection}`);
      setData(response.data.results);
      setLoading(false);
    } catch (error) {
      console.error("Error fetching sorted data:", error);
      setLoading(false);
    }
  };

  const handleDelete = async (userId: number) => {
    try {
      await axios.delete(`/api/usersdelete/${userId}`);
      // After successful deletion, fetch users again to update the list
      fetchUsers();
    } catch (error) {
      console.error("Error deleting user:", error);
    }
  };

  const fetchUsers = async () => {
    try {
      const response = await axios.get("/api/users");
      setData(response.data.results);
      setLoading(false);
    } catch (error) {
      console.error("Error fetching users:", error);
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchUsers();
  }, []); 

  return (
    <div className="w-screen p-20 items-center m-2">
      
      <CreateUser />
      <DataTable 
        title="User List" 
        columns={columns} 
        data={data} 
        onSort={handleSort} 
      />
    </div>
  ); 
}
